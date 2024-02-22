<template>
  <div class="static w-full md:h-screen bg-base pt-40 p-10 md:pl-40 md:py-20 md:pr-20">
    <div class="grid md:grid-cols-3 gap-10 h-full">
      <div class="md:col-span-2 relative">
        <img
          class="rounded-lg h-full"
          src="/src/assets/img/map.jpg"
          alt="image description"
        />
        <div
          class="absolute w-3/4 px-4 text-xl sm:text-5xl text-white top-10 left-5"
        >
          <p>Selectionne les endroits où tu as voyagé</p>
        </div>
      </div>
      <div class="grid grid-rows-2 gap-10">
        <div class="relative cursor-pointer">
          <img
            class="rounded-lg h-full"
            src="/src/assets/img/memories.jpg"
            alt="image description"
          />
          <div
            class="absolute px-4 w-3/5 text-xl sm:text-3xl text-white top-10 left-5"
          >
            <p>Garder un souvenir</p>
          </div>
        </div>
        <div class="relative cursor-pointer">
          <img
            class="rounded-lg h-full"
            src="/src/assets/img/places.jpg"
            alt="image description"
          />
          <div
            class="absolute px-4 w-3/5 text-xl sm:text-3xl text-white top-10 left-5"
          >
            <p>Mes endroits visités</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
