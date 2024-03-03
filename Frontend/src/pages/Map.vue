<template>
  <Nav></Nav>
  <div
    class="static w-full h-screen bg-base pt-32 p-10 md:pl-40 md:py-20 md:pr-20"
  >
    <div class="w-full h-full bg-dark rounded-lg">
      <l-map
        @click="onMapClick"
        ref="map"
        v-model:zoom="zoom"
        :min-zoom="6"
        :center="[47.0, 1.79]"
        :use-global-leaflet="false"
        :maxBounds="[
          [51.35835494003574, -5.503705],
          [42.221176970720435, 8.260966],
        ]"
        class="rounded-lg z-0"
      >
        <l-tile-layer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          layer-type="base"
          name="OpenStreetMap"
          :minZoom="zoom"
        ></l-tile-layer>
        <l-marker
          v-for="(memo, index) in MemoVoyage"
          :key="index"
          :id="memo.id"
          :lat-lng="[memo.latitude, memo.longitude]"
        >
          <l-popup>
            <div class="flex justify-center">
              <img class="rounded-md" :src="memo.url" alt="image_memo" />
            </div>
            <div class="font-bold text-lg">{{ memo.name }}</div>
            <!--<p>Visité le {{ memo.date_visite }}</p>
					{{ memo.note }}-->
            <button @click="deletePlace(memo.id)">Supprimer</button></l-popup
          >
        </l-marker>
      </l-map>
    </div>
    <transition name="fade">
      <div v-if="showForm">
        <div
          @click="showForm = false"
          class="absolute bg-black opacity-70 inset-0 z-40"
        ></div>
        <div
          class="w-auto max-w-lg h-auto my-10 mx-5 px-5 md:px-10 absolute inset-0 md:mx-auto rounded-xl shadow-lg bg-white z-50"
        >
          <div class="w-full h-14 relative">
            <button
              @click="showForm = false"
              class="absolute right-5 top-3 bg-transparent hover:bg-base text-dark py-2 px-4 rounded-full"
            >
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <h3 class="text-dark text-center text-2xl">Créer une note</h3>
          <div class="h-4/5 overflow-auto">
            <form class="p-4 bg-gray-200">
              <div class="mt-2">
                <label for="name" class="block text-md text-dark my-2"
                  >Nom :</label
                >
                <input
                  type="text"
                  id="name"
                  v-model.trim="this.formData.name"
                  required
                  placeholder="Mon voyage à Lyon"
                  class="block w-full bg-base outline-none rounded-md border-0 px-5 py-3 text-dark placeholder:text-light-gray text-sm"
                />
              </div>
              <div class="mt-2">
                <label for="date_visite" class="block text-md text-dark my-2"
                  >Date de visite :</label
                >
                <input
                  type="date"
                  id="date_visite"
                  v-model.trim="this.formData.date_visite"
                  required
                  class="block w-full bg-base outline-none rounded-md border-0 px-5 py-3 text-dark placeholder:text-light-gray text-sm"
                />
              </div>
              <div
                class="mt-2"
                v-for="(photo, index) in formData.photos"
                :key="index"
              >
                <label
                  :for="'photo_' + index"
                  class="block text-md text-dark my-2"
                  >Photo :</label
                >
                <input
                  type="text"
                  :id="'photo_' + index"
                  v-model.trim="formData.photos[index]"
                  required
                  placeholder="Insérez une URL vers la photo"
                  class="inline w-11/12 bg-base outline-none rounded-md border-0 px-5 py-3 text-dark placeholder:text-light-gray text-sm"
                />
                <button
                  type="button"
                  @click="removePhoto(index)"
                  class="inline w-1/12 justify-center rounded-md text-md text-dark hover:text-danger"
                >
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
              <div class="mt-2">
                <button
                  type="button"
                  @click="addPhoto"
                  class="flex w-auto px-5 my-5 justify-center rounded-md bg-accent p-3 text-md text-white hover:bg-primary"
                >
                  Ajouter une photo
                </button>
              </div>
              <div class="mt-2">
                <label for="note" class="block text-md text-dark my-2"
                  >Note:
                </label>
                <textarea
                  id="note"
                  v-model.trim="this.formData.note"
                  required
                  placeholder="C'était cool et j'ai trouvé des Marios partout"
                  class="block w-full bg-base outline-none rounded-md border-0 px-5 py-3 text-dark placeholder:text-light-gray text-sm"
                ></textarea>
              </div>

              <div
                class="my-5 w-auto bg-success text-dark text-sm me-2 px-3 py-2 rounded-full z-50"
                v-show="noteCreated"
              >
                Note créé
              </div>

              <div class="mt-2">
                <button
                  type="button"
                  @click="
                    submitForm();
                    showForm = false;
                  "
                  class="flex w-full mt-10 justify-center rounded-md bg-primary p-3 text-md text-dark"
                >
                  Soumettre
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </transition>
    <!--<form class="p-4 bg-gray-200" v-if="showForm">
      <div class="mt-2">
        <label for="name">Nom :</label>
        <input type="text" id="name" v-model="this.formData.name" required />
      </div>
      <div class="mt-2">
        <label for="date_visite">Date de visite :</label>
        <input
          type="date"
          id="date_visite"
          v-model="this.formData.date_visite"
          required
        />
      </div>
      <div class="mt-2" v-for="(photo, index) in formData.photos" :key="index">
        <label :for="'photo_' + index">Photo :</label>
        <input
          type="text"
          :id="'photo_' + index"
          v-model="formData.photos[index]"
          required
        />
        <button type="button" @click="removePhoto(index)">Supprimer</button>
      </div>
      <div class="mt-2">
        <button type="button" @click="addPhoto">Ajouter une photo</button>
      </div>
      <div class="mt-2">
        <label for="note">Note: </label>
        <textarea id="note" v-model="this.formData.note" required></textarea>
      </div>
      <div class="mt-2">
        <button type="button" @click="submitForm">Soumettre</button>
      </div>
    </form>-->
  </div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import { LMap, LMarker, LTileLayer, LPopup } from "@vue-leaflet/vue-leaflet";
import L from "leaflet";
import StarRating from "vue-star-rating";
import MapDataServices from "../services/MapDataServices";
import Nav from '/src/components/Nav.vue'

export default {
  components: {
    Nav,
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    StarRating,
  },
  data() {
    return {
      zoom: 6,
      MemoVoyage: [],
      formData: {
          name: "",
          date_visite: "",
          note: "",
          photos: [],
        },
      latitude: 0,
      longitude: 0,
      currentMarker: null,
      showForm: false,
      noteCreated: false,
    };
  },
  mounted() {
    MapDataServices.getPlaces()
      .then((response) => {
        console.log(response.data[0]);
        this.MemoVoyage = response.data[0];
        console.log(response.data[0]);

        this.MemoVoyage.forEach((element) => {
          MapDataServices.getPlaceDetailed(element.id)
            .then((response) => {
              if(response.data[0].memo.photos && response.data[0].memo.photos.length > 0)
            element.url = response.data[0].memo.photos[0].url;
              else
            element.url = '/src/assets/img/caravan.jpg';
            })
            .catch((e) => {
              console.log(e);
            });
        });
        console.log(this.MemoVoyage);
      })
      .catch((error) => {
        console.error("Erreur lors de la récupération des données:", error);
      });
  },
  methods: {
    addPhoto() {
      this.formData.photos.push("");
    },
    removePhoto(index) {
      this.formData.photos.splice(index, 1);
    },
    deletePlace(id) {
      MapDataServices.deletePlace(id)
        .then((response) => {
          console.log(response.data);
          this.MemoVoyage = this.MemoVoyage.filter((item) => item.id !== id);
        })
        .catch((e) => {
          console.log(e);
        });
    },
    submitForm() {
      console.log({
        ...this.formData,
        latitude: this.latitude,
        longitude: this.longitude,
      });
      MapDataServices.addPlace({
        ...this.formData,
        latitude: this.latitude,
        longitude: this.longitude,
      })
        .then((response) => {
          console.log(response.data);
          this.MemoVoyage.push({
            id: response.data.id,
            ...this.formData,
            latitude: this.latitude,
            longitude: this.longitude,
          });
          (this.formData.name = ""),
            (this.formData.date_visite = ""),
            (this.formData.note = ""),
            (this.formData.photos = [""]);
        })
        .catch((e) => {
          console.log(e);
        });
    },
    onMapClick(e) {
      this.latitude = e.latlng.lat;
      this.longitude = e.latlng.lng;
      console.log(this.latitude, this.longitude);
      if (this.currentMarker) {
        this.currentMarker.removeFrom(e.target);
      }

      // Créer un nouveau marqueur aux nouvelles coordonnées
      this.currentMarker = L.marker(e.latlng).addTo(e.target);
      this.showForm = true;
    },
  },
};
</script>

<style>
.leaflet-popup-content-wrapper {
  border-radius: 25px;
}
.leaflet-popup-content {
  width: 200px;
  max-width: 200px;
}
.leaflet-container a.leaflet-popup-close-button {
  width: 30px;
}
</style>
