<template>
  <Nav></Nav>
  <router-view></router-view>
</template>

<script>
import { ref, defineComponent, provide, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import { RouterView } from 'vue-router';
import Nav from '/src/components/Nav.vue'

export default defineComponent({
  name: "App",
  components: {
    Nav,
    RouterView,
  },
  setup() {
    const router = useRouter();
    const route = useRoute();
    const session = ref(false);

    // Functions
    const onLogout = async () => {
      try {
        localStorage.removeItem("jwt");
        isActiveSession();
      } catch (error) {
        console.error(error);
      }
    };

    const isActiveSession = async () => {
      try {
        const jwt = localStorage.getItem("jwt");

        if (!jwt) {
          console.error("Cannot obtain the session data");
          localStorage.removeItem("jwt");
          return router.push({ name: "Login" });
        } else {
          session.value = true;
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


