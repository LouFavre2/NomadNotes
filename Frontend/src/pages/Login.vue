<template>
  <div class="h-screen">
    <div class="h-screen hidden md:block static">
      <img
        class="object-cover h-screen w-screen"
        src="../assets/img/caravan.jpg"
      />
    </div>
    <div
      class="h-screen w-full bg-white p-10 md:w-1/2 md:absolute md:top-0 md:right-0 z-40 md:rounded-l-lg md:p-20 lg:p-10"
    >
      <h2 class="text-dark text-center text-2xl lg:mt-14">Se connecter</h2>

      <div class="mt-20 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="name" class="block text-sm text-dark">E-mail</label>
            <div class="mt-2">
              <input
                v-model.trim="dataForm.email"
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="exemple@exemple.com"
                required=""
                class="block w-full bg-base outline-none rounded-md border-0 p-3 text-dark placeholder:text-light-gray text-sm"
              />
            </div>
          </div>

          <div>
            <label for="name" class="block text-sm text-dark"
              >Mot de passe</label
            >
            <div class="mt-2">
              <input
                v-model.trim="dataForm.password"
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="********"
                required=""
                class="block w-full bg-base outline-none rounded-md border-0 p-3 text-dark placeholder:text-light-gray text-sm"
              />
            </div>
          </div>

          <p v-if="textError" class="mt-2 text-sm text-medium-red">
            {{ textError }}
          </p>

          <div>
            <button
              type="submit"
              :disabled="isLoading"
              class="flex w-full mt-14 justify-center rounded-md bg-primary p-3 text-md text-dark"
              @click.prevent="onSignIn()"
            >
              {{ isLoading ? "Chargement ..." : "Suivant" }}
            </button>
          </div>

          <p class="mt-5 text-center text-sm text-medium-gray">
            Tu n'as pas un compte ?
            {{ " " }}
            <a
              href="#"
              class="font-semibold leading-6 text-dark"
              @click.prevent="router.push({ name: 'Signup' })"
              >S'enregistrer</a
            >
          </p>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { useRouter } from "vue-router";
import { inject, ref } from "vue";
import axios from "axios";

export default {
  setup() {
    const router = useRouter();

    // Inject
    const sessionValue = inject("session");

    const isLoading = ref(false);
    const dataForm = ref({
      email: "",
      password: "",
    });
    const textError = ref("");

    // * Sign in user *
    const onSignIn = async () => {
      const { email, password } = dataForm.value;
      const regExEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

      if (!email || !password) {
        return (textError.value = "Tous les champs sont obligatoires pour vous connecter");
      }
      if (password.length < 8) {
        return (textError.value = "Veuillez entrer un mot de passe fort");
      }
      if (!regExEmail.test(email)) {
        return (textError.value = "Veuillez entrer un email valide");
      }

      isLoading.value = true;
      try {
        const { data } = await axios.post(
          `${import.meta.env.VITE_API_URL}/login`,
          {
            email,
            password,
          }
        );
        if (!data.accessToken)
          return (textError.value =
            "Une erreur s'est produite lors de la connexion, réessayez plus tard.");

        // Update session value and redirect to dashboard
        localStorage.setItem("jwt", data.accessToken);
        isLoading.value = false;
        sessionValue.active();
      } catch (error) {
        textError.value =
          "Nom d'utilisateur ou mot de passe incorrect, vérifiez vos données et réessayez";
        isLoading.value = false;
      }
    };

    return {
      // Data
      dataForm,
      isLoading,
      textError,
      // Functions
      onSignIn,
      // Utils
      router,
    };
  },
};
</script>
