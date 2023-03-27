<script>
export default {
  created() {
    this.getUserLocation();
  },

  mounted() {
    setTimeout(() => this.getForecast(), 500);
  },

  data() {
    return {
      current: {
        temperature: 0,
        description: '',
        date: '',
        temp_max: 0,
        temp_min: 0,
        summary: '',
        feels_like: 0,
        icon: '',
      },

      nearbyPlaces: [],
      weathers: [],

      location: {
        name: '',
        country: '',
        lat: 0,
        long: 0,
      },

      search: {
        query: '',
        limit: 5,
      }
    }
  },

  computed: {
    currentWeather() {
        if (this.$data.weathers.length > 0) {
          const now = new Date();
          let weathers = [];
          this.$data.weathers.forEach((weather, index) => {
           weathers[index] = {
              date: new Date(weather.date),
              description: weather.description,
              temp_max: weather.temp_max,
              temp_min: weather.temp_min,
              temperature: weather.temperature,
              feels_like: weather.feels_like,
              summary: weather.weather,
              icon: weather.icon
           }
          });

          weathers.sort((a,b) => {
            let firstDistance = Math.abs(now - a.date);
            let secondDistance = Math.abs(now - b.date);
            return firstDistance - secondDistance;
          });

          this.$data.current = weathers[0];
          return weathers[0];
        }

        return {
          date: new Date().toLocaleDateString(),
          description: '',
          temp_max: 0,
          temp_min: 0,
          temperature: 0,
          feels_like: 0,
          summary: '',
          icon: ''
        }
      }
    },

  methods: {
    getForecast() {
      let urlQuery = `&lat=${this.$data.location.lat}&long=${this.$data.location.long}`;
      
      if (this.search.query != '') {
        urlQuery = `q=${this.$data.search.query}`;
      }

      axios.get(
        `${localUrl}/weather?${urlQuery}&limit=${this.search.limit}`
      )
      .then((response) => {
        let data = response.data.data;
        this.$data.location.name = data.city.name;
        this.$data.location.country = data.city.country;
        this.$data.location.lat = data.city.coord.lat;
        this.$data.location.long = data.city.coord.lon;
        this.$data.weathers = data.weathers;
        setTimeout(() => this.getNearbyPlaces(), 800);
      })
      .catch((err) => {
        alert(`${this.search.query} does not exist or available on our records.`);
      });
    },

    getNearbyPlaces() {
      let query = encodeURIComponent(`${this.$data.location.name},${this.$data.location.country}`);

      axios.get(
      `${localUrl}/places?q=${query}&limit=${this.search.limit}`
      ).
      then((response) => {
        let data = response.data.data;
        let { geolocation, places } = data;

        this.$data.nearbyPlaces = places;
      });
    },

    toDayOfWeek(date) {
      const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
      const timestamp = Math.floor(new Date(date).getTime() / 1000);
      const newDate = new Date(timestamp * 1000);

      return days[newDate.getDay()];
    },

    formatDate(date) {
      return new Date(date).toLocaleString();
    },

    getUserLocation() {
      const options = {
        enableHighAccuracy: true,
        timeout: 5000,
      };

      const successCallback = (position) => {
        this.$data.location.lat = position.coords.latitude;
        this.$data.location.long = position.coords.longitude;
      };

      const failCallback = (error) => {
        alert(`Please enable browser location for app to 
        detect your current location's weather and places.`);
      };

      const geolocation = navigator.geolocation;
      geolocation.getCurrentPosition(successCallback, failCallback, options);
    },
  },
}
</script>


<template>
  <div class="mb-8 text-white">
    <div class="text-gray-800 places-input">
      <input type="text" class="w-full p-6 text-2xl font-semibold rounded-md"
        @change="getForecast()" v-model="search.query"
        placeholder="Search and press Enter.."
      >
    </div>
    <div class="max-w-lg p-4 mt-4 overflow-hidden font-sans bg-gray-900 rounded-t-lg shadow-lg weather-container w-138">
      <!-- current weather -->
      <div class="flex items-center justify-between px-6 py-8 current-weather">
        <div class="flex items-center">
          <div>
            <p class="text-4xl font-extrabold">{{ currentWeather.temperature }}°C</p>
            <p class="mt-4">Feels like {{ currentWeather.feels_like }}°C</p>
            <p class="mt-2 text-xs">{{ formatDate(currentWeather.date) }}</p>
          </div>
          <div class="mx-8">
            <p class="font-semibold">{{ currentWeather.summary }}</p>
            <span>{{ location.name }}, {{ location.country }}</span>
          </div>
        </div>

        <div><img :src="currentWeather.icon" alt="weather icon" width="80"/></div>
      </div>
    </div> <!-- Current Weather-->

    <!-- Future Weather-->
    <div class="px-6 py-8 overflow-hidden text-sm bg-gray-800 rounded-b-lg future-weather">
      <div class="flex items-center mt-8" v-for="weather in weathers" v-key="weather.id">
        <div class="w-1/6 text-lg font-semibold text-gray-200">
          <p>{{ toDayOfWeek(weather.date) }}</p>
          <small class="text-xs">{{ formatDate(weather.date) }}</small>
        </div>
        <div class="flex items-center w-4/6 px-4">
          <div>
            <img :src="current.icon" alt="weather icon" width="40"/>
          </div>
          <div class="ml-3">
            <h5 class="font-extrabold uppercase">{{ weather.weather }}</h5>
            <span class="capitalize">{{ weather.description }}</span>
          </div>
        </div>
        <div class="w-1/6 text-right">
          <p>{{ weather.temp_max }}°C</p>
          <p>{{ weather.temp_min }}°C</p>
        </div>
      </div> <!-- Future weather information-->
    </div>

    <!-- Nearby Places -->
    <div class="px-6 py-8 mt-4 overflow-hidden text-sm bg-gray-900 rounded-t-lg nearby-places">
      <div class="flex items-center mt-1 text-center">
        <div class="w-full text-lg font-semibold text-gray-200 uppercase">
          Nearby places in {{ location.name }}
        </div>
      </div> <!-- Nearby Places-->
    </div>

    <div class="px-6 py-8 overflow-hidden text-sm bg-gray-800 rounded-b-lg future-weather">
      <div class="flex items-center mt-9" v-for="place in nearbyPlaces" v-key="place.fsq_id">
        <div class="w-full pb-2 text-lg font-semibold text-center text-gray-200 border-b-2 border-b-gray-200">
          <h5 class="uppercase">{{ place.name }}</h5>
          <p class="text-sm font-semibold">{{ place.location.formatted_address }}</p>
          <p class="text-sm">Distance: {{ place.distance }} meters | <small>Timezone: {{ place.timezone }}</small></p>
        </div>
      </div> <!-- Future weather information-->
    </div>
  </div>
</template>
