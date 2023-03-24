<script>
</script>


<template>
  <div class="text-white mb-8">
    <div class="places-input text-gray-800">
      <input type="text" class="w-full p-6 text-2xl font-semibold rounded-md">
    </div>
    <div class="weather-container font-sans w-138 max-w-lg overflow-hidden bg-gray-900 shadow-lg mt-4 p-4 rounded-t-lg">
      <!-- current weather -->
      <div class="current-weather flex items-center justify-between px-6 py-8">
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
    <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden rounded-b-lg">
      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg text-gray-200 font-semibold">MON</div>
        <div class="w-4/6 px-4 flex items-center">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->

      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg text-gray-200 font-semibold">MON</div>
        <div class="w-4/6 px-4 flex items-center">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->

      <div class="flex items-center mt-8">
        <div class="w-1/6 text-lg text-gray-200 font-semibold">MON</div>
        <div class="w-4/6 px-4 flex items-center">
          <div>ICON</div>
          <div class="ml-3">Cloudy with a chance of meat balls</div>
        </div>
        <div class="w-1/6 text-right">
          <p>2°C</p>
          <p>-2°C</p>
        </div>
      </div> <!-- Future weather information-->
    </div>
  </div>
</template>
