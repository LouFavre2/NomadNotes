<template>
  <nav
    class="fixed top-0 z-50 w-screen px-6 py-8 md:hidden rounded-b-md bg-white shadow-lg"
  >
    <div class="flex items-center justify-between">
      <router-link
        to="/"
        class="text-xl font-bold text-gray-100 md:text-2xl hover:text-indigo-400"
        >Logo
      </router-link>
      <!-- Mobile menu button -->
      <div @click="toggleNav" class="flex md:hidden">
        <button
          type="button"
          class="text-gray-100 hover:text-gray-400 focus:outline-none focus:text-gray-400"
        >
          <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
            <path
              fill-rule="evenodd"
              d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
            ></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
    <div
      class="absolute z-40 top-24 right-1 bg-white rounded-md text-left shadow-lg"
    >
      <ul
        :class="showMenu ? 'flex' : 'hidden'"
        class="flex-col space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 mt-0 px-10 py-5"
      >
        <li class="text-dark px-3 py-3">
          <router-link to="/">Home</router-link>
        </li>
        <li class="text-dark px-3 py-3">
          <router-link to="/map">Garder un endroit</router-link>
        </li>
        <li class="text-dark px-3 py-3">
          <router-link to="/my-places">Mes endroits</router-link>
        </li>
      </ul>
    </div>
  </nav>

  <div
    id="logo-sidebar"
    class="bg-white fixed top-0 left-0 z-40 w-20 h-screen transition-transform -translate-x-full md:translate-x-0 shadow-lg rounded-r-md"
    aria-label="Sidebar"
  >
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
        <img
          src="https://flowbite.com/docs/images/logo.svg"
          class="h-10 sm:h-10"
          alt="Flowbite Logo"
        />
      </a>
      <ul class="space-y-20 font-medium mt-32">
        <li class="mx-2">
          <router-link to="/" class="text-dark" active-class="text-primary">
            <i class="fa-solid fa-house text-4xl"></i>
          </router-link>
        </li>
        <li class="mx-2">
          <router-link to="/map" class="text-dark" active-class="text-primary">
            <i class="fa-solid fa-map text-4xl"></i>
          </router-link>
        </li>
        <li class="mx-2">
          <router-link to="/my-places" class="text-dark" active-class="text-primary">
            <i class="fa-solid fa-heart text-4xl"></i>
          </router-link>
        </li>
      </ul>
      <div class="absolute bottom-8 left-5">
        <router-link to="/" class="text-dark">
          <i class="fa-solid fa-right-from-bracket text-4xl"></i>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
export default {
  setup() {
    let showMenu = ref(false);
    const toggleNav = () => (showMenu.value = !showMenu.value);
    return { showMenu, toggleNav };
  },
};
</script>
