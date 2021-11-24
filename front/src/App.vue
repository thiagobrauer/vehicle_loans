<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <div class="d-flex align-center">
        <span>Financiamento de veículos</span>
      </div>
    </v-app-bar>

    <v-main>
      <VehicleLoan/>
    </v-main>
  </v-app>
</template>

<script>
import VehicleLoan from './components/VehicleLoan';

export default {
  name: 'App',

  components: {
    VehicleLoan,
  },

  data: () => ({
    //
  }),
};
</script>
