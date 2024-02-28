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
				<l-marker v-for="(memo, index) in MemoVoyage" :key="index"  :lat-lng="memo.endroit" draggable>
					<l-popup><p>Visité le {{ memo.date_visite }}</p>
					{{ memo.description }}
					<star-rating :show-rating="false" v-model:rating="memo.note" read-only :star-size=20	 ></star-rating>
					<button>Modifier</button>
					<button>Supprimer</button></l-popup>
				</l-marker>
			</l-map>
		</div>
	</div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import { LMap, LMarker, LTileLayer, LPopup } from "@vue-leaflet/vue-leaflet";
import L from "leaflet";
import StarRating from 'vue-star-rating'
import $ from "jquery";
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
      MemoVoyage: [{
		"description": "Ceci est une description",
        "note": 5,
        "date_visite" : "02/02/2018",
        "endroit" : [45.8566, 2.3522]
      },
      {
		"description": "Description",
        "note": 2,
        "date_visite" : "02/03/2018",
        "endroit" : [48.8566, 4.3522]
      }],
    formData: {
        nom: "",
        dateVisite: "",
        note: null,
        description: ""
      }
    };
},
  mounted() {
    MapDataServices.getPlaces().then(response => {
        console.log(response.data)
    })
  },
methods: {
	submitForm() {
	  console.log("ok")
	  console.log("Formulaire soumis :", this.formData)
	},
	onMapClick(e) {
	var self = this;
    var popupContent = `
    <form ref="form"id="form" @submit.prevent="this.submitForm">
      <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" v-model="formData.nom" required>
      </div>
      <div>
        <label for="dateVisite">Date de visite :</label>
        <input type="date" id="dateVisite" v-model="formData.dateVisite" required>
      </div>
      <div>
        <label for="note">Note :</label>
        <input type="number" id="note" v-model="formData.note" min="0" max="10" required>
      </div>
      <div>
        <label for="description">Description :</label>
        <textarea id="description" v-model="formData.description" required></textarea>
      </div>

      <div>
        <button type="submit">Soumettre</button>
      </div>
    </form>
  `;
  //alert("You clicked the map at " + e.latlng);
  var popup = L.popup()
  .setLatLng(e.latlng)
  .setContent(popupContent)
  .openOn(e.target);
  // Ajouter un écouteur d'événement jQuery sur la soumission du formulaire
  $("#form").submit(function(e) {
  e.preventDefault();
  console.log("La méthode submitForm a été appelée !");
  console.log("Formulaire soumis :", self.formData);
  });
},

  }
};
</script>