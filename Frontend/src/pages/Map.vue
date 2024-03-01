<template>
	<div class="static w-full h-screen bg-base pt-40 p-10 md:pl-40 md:py-20 md:pr-20">
		<div class="w-full h-full bg-dark rounded-lg">
			<l-map @click="onMapClick" ref="map" v-model:zoom="zoom" :center="[47.00000, 1.79000]" :use-global-leaflet="false" :maxBounds="[[51.35835494003574, -5.503705],[42.221176970720435, 8.260966]]">
				<l-tile-layer
					url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
					layer-type="base"
					name="OpenStreetMap"
					:minZoom="zoom"
				></l-tile-layer>
				<l-marker v-for="(memo, index) in MemoVoyage" :key="index" :id="memo.id" :lat-lng="[memo.latitude, memo.longitude]">
					<l-popup>
            <div class="flex justify-center">
            <img class="rounded-md"
              :src="memo.url"
              alt="image_memo"
            /></div>
            <div class="font-bold text-lg">{{ memo.name }}</div>
            <!--<p>Visité le {{ memo.date_visite }}</p>
					{{ memo.note }}-->
					<button>Supprimer</button></l-popup>
				</l-marker>
			</l-map>
		</div>
  <form class="p-4 bg-gray-200" v-if="showForm">
      <div class="mt-2">
        <label for="name">Nom :</label>
        <input type="text" id="name" v-model="this.formData.name" required>
      </div>
      <div class="mt-2">
        <label for="date_visite">Date de visite :</label>
        <input type="date" id="date_visite" v-model="this.formData.date_visite" required>
      </div>
      <div class="mt-2" v-for="(photo, index) in formData.photos" :key="index">
        <label :for="'photo_' + index">Photo :</label>
        <input type="text" :id="'photo_' + index" v-model="formData.photos[index]" required>
        <button type="button" @click="removePhoto(index)"> Supprimer</button>
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
    </form>
  </div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import { LMap, LMarker, LTileLayer, LPopup } from "@vue-leaflet/vue-leaflet";
import L from "leaflet";
import StarRating from 'vue-star-rating'
import MapDataServices from '../services/MapDataServices'
export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
	StarRating
  },
  data() {
    return {
      zoom: 6,
      MemoVoyage: [],
      addPhoto() {
      this.formData.photos.push("");
    },
    removePhoto(index) {
      this.formData.photos.splice(index, 1);
    },
    formData: {
        name: "",
        date_visite: "",
        note: "",
        photos: [""]
      },
      latitude: 0,
      longitude: 0,
      currentMarker: null,
      showForm: false,
    };
},
  mounted() {
    MapDataServices.getPlaces().then(response => {
        console.log(response.data[0])
        this.MemoVoyage = response.data[0]
        console.log(response.data[0])

        this.MemoVoyage.forEach(element => {
          MapDataServices.getPlaceDetailed(element.id).then((response) => {

            element.url = response.data[0].memo.photos[0].url;
          })
          .catch((e) => {
            console.log(e)
        })
          
        });
        console.log(this.MemoVoyage)


    }).catch(error => {
    console.error('Erreur lors de la récupération des données:', error);
  });

  },
methods: {
  /*getPicture(e) {
    MapDataServices.getPlaceDetailed(e).then((response) => {
      console.log(response.data[0])
      console.log(response.data[0].memo.photos[0].url)
      return response.data[0].memo.photos[0].url
    })
    .catch((e) => {
      console.log(e)
  })
  },*/
  submitForm() {
    console.log("ça marche")
    console.log({...this.formData, latitude: this.latitude, longitude: this.longitude })
    MapDataServices.addPlace({...this.formData, latitude: this.latitude, longitude: this.longitude })
        .then((response) => {
          console.log(response.data);
        })
        .catch((e) => {
          console.log(e);
        });
  },
  onMapClick(e) {
    this.latitude=e.latlng.lat
    this.longitude=e.latlng.lng
    console.log(this.latitude, this.longitude)
    if (this.currentMarker) {
        this.currentMarker.removeFrom(e.target);
      }

      // Créer un nouveau marqueur aux nouvelles coordonnées
      this.currentMarker = L.marker(e.latlng).addTo(e.target);
      this.showForm=true;
  }
}
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