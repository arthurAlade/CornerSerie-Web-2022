<template>
    <div>
        <h4>Séries</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Série</th>
                    <th>Saison</th>
                    <th>Date début d'emprunt</th>
                    <th>Date de fin d'emprunt</th>
                </tr>
            </thead>
            <tbody>
                <emprunt-serie v-for="(emprunt, index) in emprunts" :key="index" :emprunt="emprunt" :emprunt_actif="emprunt_actif"/>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import EmpruntSerie from './EmpruntSerie.vue';
const props = defineProps({
  emprunts: Array,
  emprunt_actif: Boolean
})
</script>