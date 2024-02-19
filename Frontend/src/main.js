import { createApp } from "vue";
import {createRouter, createWebHistory } from 'vue-router'
import "./style.css";
import App from "./App.vue";

import Home from "/src/pages/Home.vue";

const router = createRouter({
  history: createWebHistory(),

  routes: [
    { path: "/", name: "Home", component: Home },
  ],
});

createApp(App).use(router).mount("#app");
