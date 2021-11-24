<template>
  <v-container class="pt-12">
    <v-row class="">
      <v-col
        cols="12"
        sm="6"
      >
        <v-select
          :items="vehicles"
          v-model="selectedVehicle"
          label="Selecione um veículo"
          outlined
          clearable
          return-object
          :loading="loadingVehicles"
        ></v-select>
      </v-col>
    </v-row>

    <v-row 
      v-if="selectedVehicle"
    >
      <v-col
        class=""
        cols="12"
      >
        <v-row class="">
          <v-col
            cols="12"
            sm="6"
          >
            <h2>Veículo selecionado</h2>
            <h2>
              <b>R$ {{ 
                selectedVehicle.amount.toLocaleString('pt-BR', {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
                })}}
              </b>
            </h2>
          </v-col>
        </v-row>

        <v-row class="">
          <v-col
            cols="12"
            sm="6"
          >
            <h4>Valor da entrada</h4>
          </v-col>
        </v-row>

        <v-row class="">
          <v-col
            cols="6"
            sm="3"
          >
            <v-text-field
              v-model="initialPayment"
              outlined
              clearable
              prefix="R$"
            ></v-text-field>
          </v-col>
          
          <v-col
            cols="6"
            sm="3"
          >
            <v-btn 
              color="primary"
              block 
              x-large
              @click="fetchLoanOptions"
            >
              SIMULAR
            </v-btn>
          </v-col>
        </v-row>

        <v-row v-if="loadingLoanOptions">
          <v-col
            class=""
            cols="12"
          >
            <v-progress-circular
              indeterminate
              color="primary"
            ></v-progress-circular>
          </v-col>
        </v-row>

        <v-row v-if="loanOptions.length > 0">
          <v-col
            cols="12"
            sm="6"
          >
            <h3>Valores simulados para você</h3>
          </v-col>
        </v-row>

        <v-row v-if="loanOptions.length > 0">
          <v-col
            cols="12"
          >
            <p v-for="option in loanOptions" v-bind:key="option.installments">
              {{ option.installments }}x de R$ {{ option.amount }}
            </p>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'VehicleLoan',

    data: () => ({
      loadingVehicles: false,
      initialPayment: 0,
      selectedVehicle: null,
      vehicles: [],
      loadingLoanOptions: false,
      loanOptions: [],
    }),

    mounted: function () {
      this.fetchVehiclesList()
    },

    methods: {
      fetchVehiclesList: function () {
        this.loadingVehicles = true

        setTimeout(() => {
          this.vehicles = [
            { text: 'Carro1', value: 1, amount: 12345.12 },
            { text: 'Carro2', value: 2, amount: 12345.00 },
            { text: 'Carro3', value: 3, amount: 12345.00 },
          ]       

          this.loadingVehicles = false

        }, 3000)
      },

      fetchLoanOptions: function () {
        this.loadingLoanOptions = true

        setTimeout(() => {
          this.loanOptions = [
            { installments: 12, amount: 12345 },
            { installments: 12, amount: 12345 },
            { installments: 12, amount: 12345 },
          ]

          this.loadingLoanOptions = false

        }, 2000)

      }
    }
  }
</script>
