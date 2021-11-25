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
          item-text="name"
          item-value="id"
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
        cols="12"
      >
        <v-row class="">
          <v-col
            cols="12"
            sm="6"
          >
            <h2>{{ selectedVehicle.name }}</h2>
            <h2>
              <b>R$ {{ 
                (selectedVehicle.amount / 100).toLocaleString('pt-BR', {
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
            cols="12"
            sm="3"
          >
            <v-currency-field 
              prefix="R$"
              outlined
              clearable
              v-model="initialPayment"
            />
          </v-col>
          
          <v-col
            cols="12"
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
              {{ option.installments }}x de R$ 
                {{ (option.amount / 100).toLocaleString('pt-BR', {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
                }) }}
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

        fetch('http://localhost:8000/api/vehicles')
          .then(async response => {
            if(response.ok) {
              let data = await response.json()
            
              this.vehicles = data
            }

            this.loadingVehicles = false
          })

      },

      fetchLoanOptions: function () {
        this.loadingLoanOptions = true

        fetch(`http://localhost:8000/api/vehicles/${this.selectedVehicle.id}/loan-options?initialPayment=${parseFloat(this.initialPayment) * 100}`)
          .then(async response => {
            if(response.ok) {
              let data = await response.json()
            
              this.loanOptions = data
            }

            this.loadingLoanOptions = false
          })
      }
    }
  }
</script>
