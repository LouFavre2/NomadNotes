import { createApp } from "vue";
import {createRouter, createWebHistory } from 'vue-router'
import "./style.css";
import App from "./App.vue";

import Home from "/src/pages/Home.vue";
import Signup from "/src/pages/Signup.vue";
import Login from "/src/pages/Login.vue";
import Map from "/src/pages/Map.vue";
import Places from "/src/pages/Places.vue";


const router = createRouter({
  history: createWebHistory(),

  routes: [
    { path: "/register", name: "Signup", component: Signup },
    { path: "/login", name: "Login", component: Login },
    { path: "/", name: "Home", component: Home },
    { path: "/map", name: "Map", component: Map },
    { path: "/my-places", name: "Places", component: Places },

  ],
});

createApp(App).use(router).mount("#app");
