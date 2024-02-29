<template>
  <Nav></Nav>
  <router-view></router-view>
</template>

<script>
import { ref, computed, defineComponent, provide, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import { RouterView } from 'vue-router';
import Nav from '/src/components/Nav.vue'
import axios from "axios";
const API_URL = import.meta.env.VITE_API_URL;

export default defineComponent({
  name: "App",
  setup() {
    const router = useRouter();
    const route = useRoute();
    const session = ref(false);

    // Functions
    const onLogout = async () => {
      const jwt = localStorage.getItem("jwt");
      try {
        await axios.get(`${API_URL}/logout`, {
          headers: { Authorization: `Bearer ${jwt}` },
        });
        await new Promise((resolve) => setTimeout(resolve, 10000));
        isActiveSession();
      } catch (error) {
        console.error(error);
      }
    };

    const isActiveSession = async () => {
      const jwt = localStorage.getItem("jwt");
      try {
        const { data } = await axios.get(`${API_URL}/auth/user`, {
          headers: { Authorization: `Bearer ${jwt}` },
        });

        if (data) {
          session.value = data;
        } else {
          console.error("Cannot obtain the session data");
          localStorage.removeItem("jwt");
          return router.push({ name: "Login" });
        }

        if (route.name == "Signup" || route.name == "Login") {
          return router.push({ name: "Home" });
        }
      } catch (error) {
        localStorage.removeItem("jwt");
        console.error(error);
        return router.push({ name: "Login" });
      }
    };

    // Inject
    provide("session", {
      get: () => {
        return {
          session: computed(() => session.value),
          active: isActiveSession(),
        };
      },
      logout: onLogout,
      active: isActiveSession,
    });

    onMounted(() => {
      isActiveSession();
    });
  },
});
</script>


