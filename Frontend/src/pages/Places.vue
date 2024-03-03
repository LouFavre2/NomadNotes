<template>
  <Nav></Nav>
  <div
    class="static w-full h-screen bg-base pt-40 p-10 md:pl-40 md:py-20 md:pr-20 overflow-auto"
  >
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
      <div
        v-for="memo in memos"
        :key="memo.id"
        class="bg-white rounded-lg w-full p-5 flex flex-col"
      >
        <img
          class="h-4/5 w-full max-w-full rounded-md"
          :src="getMemoPhotoPath(memo)"
          alt="image_memo"
        />
        <p class="h-8 my-5 text-xl text-left">{{ memo.place.name }}</p>
        <p class="flex-grow text-sm text-medium-gray">{{ memo.note }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import MapDataServices from "../services/MapDataServices";
import Nav from '/src/components/Nav.vue'

export default {
  components: {
    Nav
  },
  data() {
    return {
      memos: [],
    };
  },
  async mounted() {
    await this.fetchUserMemo();
  },
  methods: {
    async fetchUserMemo() {
      try {
        const response = await MapDataServices.getMemos();
        this.memos = response.data.$memosData;
        console.log(response.data.$memosData);
      } catch (error) {
        console.error("Erreur lors de la récupération des lieux:", error);
      }
    },

    getMemoPhotoPath(memo) {
      if (memo.photos && memo.photos.length > 0) {
        return memo.photos[0].url;
      } else {
        return "/src/assets/img/caravan.jpg";
      }
    },
  },
};
</script>
