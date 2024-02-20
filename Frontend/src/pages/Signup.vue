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
        <form class="space-y-6" action="#">
          <div>
            <label for="name" class="block text-sm text-dark">Prénom</label>
            <div class="mt-2">
              <input
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

          <div>
            <button
              type="submit"
              class="flex w-full mt-14 justify-center rounded-md bg-primary p-3 text-md text-dark"
            >
              Suivant
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
import { useRouter } from "vue-router";

export default {
  setup() {
    const router = useRouter();

    return {
      router,
    };
  },
};
</script>
