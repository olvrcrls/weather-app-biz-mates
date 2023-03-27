<script>
export default {
  created() {
    this.getUserLocation();
  },

  mounted() {
    setTimeout(() => this.fetchForecast(), 500);
  },

  data() {
    return {
      currentTemperature: {
        actual: '',
        feelsLike: '',
        summary: '',
        icon: '',
      },

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

  methods: {
    fetchForecast() {
      let urlQuery = `&lat=${this.location.lat}&long=${this.location.long}`;
      
      if (this.search.query != '') {
        urlQuery = `q=${this.search.query}`;
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
      })
      .catch((err) => console.log(err));
    },

    toDayOfWeek(timestamp) {
      const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
      const newDate = new Date(timestamp*1000);

      return days[newDate.getDay()];
    },

    getUserLocation() {
      const successCallback = (position) => {
        this.$data.location.lat = position.coords.latitude;
        this.$data.location.long = position.coords.longitude;
      };

      const failCallback = (error) => {
        alert(`Please enable browser location for app to 
        detect your current location's weather and places.`);
      };

      const geolocation = navigator.geolocation;
      geolocation.getCurrentPosition(successCallback, failCallback);
    }
  }
}
</script>


<template>
  <div class="mb-8 text-white">
    <div class="text-gray-800 places-input">
      <input type="text" class="w-full p-6 text-2xl font-semibold rounded-md" @change="fetchForecast()" v-model="search.query">
    </div>
    <div class="max-w-lg p-4 mt-4 overflow-hidden font-sans bg-gray-900 rounded-t-lg shadow-lg weather-container w-138">
      <!-- current weather -->
      <div class="flex items-center justify-between px-6 py-8 current-weather">
        <div class="flex items-center">
          <div>
            <p class="text-6xl font-extrabold">8°C</p>
            <p class="mt-4">Feels like 2°C</p>
          </div>
          <div class="mx-8">
            <p class="font-semibold">Cloudy</p>
            <span>Manila, Philippines</span>
          </div>
        </div>

        <div>ICON</div>
      </div>
    </div> <!-- Current Weather-->

    <!-- Future Weather-->
    <div class="px-6 py-8 overflow-hidden text-sm bg-gray-800 rounded-b-lg future-weather">
      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg font-semibold text-gray-200">MON</div>
        <div class="flex items-center w-4/6 px-4">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->

      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg font-semibold text-gray-200">MON</div>
        <div class="flex items-center w-4/6 px-4">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->

      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg font-semibold text-gray-200">MON</div>
        <div class="flex items-center w-4/6 px-4">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->
    </div>

    <!-- Nearby Places -->
    <div class="flex mt-8 flex-items">
        <div class="max-w-lg p-4 mt-4 overflow-hidden bg-gray-900 rounded-lg shadow-lg w-138">
          <h1 class="p-4 font-sans text-3xl uppercase semi-bold">Nearby Places - {{ location.name }}</h1>
        </div>
      </div>
  </div>
</template>
