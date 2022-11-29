<template>
    <div>
        <h2>Mes emprunts</h2>
        <h3>Emprunts en cours :</h3>
       <emprunts-films-table :emprunt_actif="true" :emprunts="empruntsFilms.current" v-if="empruntsFilms.current"/>
        <emprunts-series-table :emprunt_actif="true" :emprunts="empruntsSeries.current" v-if="empruntsSeries.current" />
        <h3>Emprunts passés :</h3>
         <emprunts-films-table :emprunt_actif="false" :emprunts="empruntsFilms.past" v-if="empruntsFilms.past" />
        <emprunts-series-table :emprunt_actif="false" :emprunts="empruntsSeries.past" v-if="empruntsSeries.past" />
    </div>
</template>


<script setup>

import EmpruntsFilmsTable from './EmpruntsFilmsTable.vue';
import EmpruntsSeriesTable from './EmpruntsSeriesTable.vue';
import {onBeforeMount, onMounted, ref} from 'vue';
import {Axios} from "axios";

const axios = require('axios').default;
let empruntsFilms = ref([])

const empruntsSeries = ref([])
const userID = localStorage.getItem("user_id");

onMounted(()=>{
  let urlFilms = "/api/v1/utilisateur/emprunts/films/"+userID
  let urlSeries = "/api/v1/utilisateur/emprunts/series/"+userID
  axios.get(urlFilms).then(res =>
  {
     empruntsFilms.value = {past:res.data['films']['past'], current:res.data['films']['current']}
    console.log(empruntsFilms)
  }).catch(e=>errors.value=e)

  axios.get(urlSeries).then(res =>
  {
    empruntsSeries.value = {past:res.data['series']['past'], current:res.data['series']['current']}
  }).catch(e=>errors.value=e)
})

</script>