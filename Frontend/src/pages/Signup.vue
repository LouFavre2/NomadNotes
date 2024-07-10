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
      <h2 class="text-dark text-center text-2xl lg:mt-14">S'enregistrer</h2>

      <div class="mt-14 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="name" class="block text-sm text-dark">Prénom</label>
            <div class="mt-2">
              <input
                v-model.trim="dataForm.name"
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                placeholder="Écris ton prénom"
                required=""
                class="block w-full bg-base outline-none rounded-md border-0 p-3 text-dark placeholder:text-light-gray text-sm"
              />
            </div>
          </div>

          <div>
            <label for="name" class="block text-sm text-dark">Nom</label>
            <div class="mt-2">
              <input
                v-model.trim="dataForm.lastname"
                id="lastname"
                name="lastname"
                type="text"
                autocomplete="lastname"
                placeholder="Écris ton nom"
                required=""
                class="block w-full bg-base outline-none rounded-md border-0 p-3 text-dark placeholder:text-light-gray text-sm"
              />
            </div>
          </div>

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
              @click.prevent="onSignUp()"
            >
              {{ isLoading ? "Chargement ..." : "Suivant" }}
            </button>
          </div>

          <p class="mt-5 text-center text-sm text-medium-gray">
            Tu as déjà un compte ?
            {{ " " }}
            <a
              href="#"
              class="font-semibold leading-6 text-dark"
              @click.prevent="router.push({ name: 'Login' })"
              >Se connecter</a
            >
          </p>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { inject, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

export default {
  setup() {
    const router = useRouter();

    const isLoading = ref(false);
    const dataForm = ref({
      name: "",
      lastname: "",
      email: "",
      password: "",
    });
    const textError = ref("");


    // * Sign up user *
    const onSignUp = async () => {
      const { name, lastname, email, password } = dataForm.value;
      const regExEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

      if (!name || !lastname || !email || !password) {
        return (textError.value = "Tous les champs sont obligatoires pour s'inscrire");
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
          `${import.meta.env.VITE_API_URL}/register`,
          {
            firstname: name,
            lastname,
            email,
            password,
          }
        );
        if (!data)
          return (textError.value =
            "Une erreur s'est produite lors de l'inscription, réessayez plus tard.");
        textError.value =
          "Vos données ont été correctement enregistrées, vous pouvez maintenant vous connecter.";

        // Update session value and redirect to home
        isLoading.value = false;
        await new Promise((resolve) => setTimeout(resolve, 2000));
        return router.push({ name: "Login"})
      } catch (error) {
        console.error(error);
        isLoading.value = false;
      }
    };

    return {
      // Data
      dataForm,
      isLoading,
      textError,
      // Functions
      onSignUp,
      // Utils
      router,
    };
  },
};
</script>
