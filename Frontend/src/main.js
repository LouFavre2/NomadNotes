import { createApp } from "vue";
import {createRouter, createWebHistory } from 'vue-router'
import "./style.css";
import App from "./App.vue";

import Home from "/src/pages/Home.vue";
import Signup from "/src/pages/Signup.vue";
import Login from "/src/pages/Login.vue";

const router = createRouter({
  history: createWebHistory(),

  routes: [
    { path: "/", name: "Home", component: Home },
    { path: "/register", name: "Signup", component: Signup },
    { path: "/login", name: "Login", component: Login },
  ],
});

createApp(App).use(router).mount("#app");
