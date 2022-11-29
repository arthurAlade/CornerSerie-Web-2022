<template>
    <tr>
        <td>{{ emprunt.film.titre }}</td>
        <td>{{ dateDebutFormat}}</td>
        <td>{{ dateFinFormat  }}</td>
      <td  v-show="emprunt_actif">
        <button type="submit" class="btn btn-primary" @click.prevent="rendre" >Rendre</button>
      </td>
        
    </tr>
</template>

<script setup>
import {computed} from "vue";
import dayjs from "dayjs";
import axios from "axios";
require('dayjs/locale/fr')
const props = defineProps({
  emprunt:{
    id: Number,
    film:{
      id: Number,
      titre: String
    },
    dateDebut: String,
    dateFin: String,
    actif: Boolean,
    restituer: Boolean
  },
  emprunt_actif: Boolean
})
const userID = localStorage.getItem("user_id")

const dateDebutFormat = computed(() => {
  return dayjs(props.emprunt.dateDebut, 'DD-MMMM-YYYY', 'fr')
})
const dateFinFormat = computed(() => {
  return dayjs(props.emprunt.dateFin, 'DD-MMMM-YYYY', 'fr')
})

function rendre(){
  let url = "/api/v1/utilisateur/emprunts/rendre/film/" + userID + "/" + props.emprunt.id
  axios.post(url).then(() => {
    location.reload()
  })
}
</script>