<template>

  <main>
    <div id="main">
      
      <div id="jumbotron">  
        <!-- TESTO JUMBOTRON -->
        <div class="container text-center text-white">
          <h2>Trova lo specialista che fa per te</h2>

          <p>Prenota la tua visita</p>

          <p>Cerca uno specialista adesso</p>
        </div>


        <!-- RICERCA MEDICO PER SPECIALIZZAZIONE -->
        <div class="container mt-5 pt-4">
          <form>

            <div class="row justify-content-center px-2">

              <!-- WRAPPER SELECT e BUTTON -->
              <div id="spec-wrap" class="col-12 col-lg-9 px-3 py-4 px-lg-4 py-lg-4">

                <div class="row justify-content-center">
                  <!-- SELECT SPECIALIZZAZIONI -->
                  <div class="col-12 col-lg-8 mb-2 mb-lg-0">
                    <select class="form-select p-2">
                      <option selected>Scegli una specializzazione</option>
                      <option v-for="specialty in specialtiesList" :key="specialty.id" :value="specialty.id"> {{specialty.name}} </option>
                    </select>
                  </div>

                  <!-- BUTTON CERCA -->
                  <div class="col-12 col-lg-4">
                    <button type="submit" class="btn-specialty btn p-2">Cerca</button>
                  </div>

                </div>

              </div>

            </div>

          </form>
        </div>

        <!-- RICERCA AVANZATA -->
        <div class="container">
          <div class="row justify-content-center mt-5">
              <div class="col-10 col-lg-6 text-center">
                  <a id="advanced-search" class="btn btn-success p-2" href="#">Ricerca avanzata</a>
              </div>
          </div>
        </div>

      </div>


      <!-- SEZIONE DOTTORI SPONSORIZZATI -->
      <HomeSponsorizzati :doctors="docsList"></HomeSponsorizzati>
      <!-- FINE SEZIONE DOTTORI SPONSORIZZATI -->

    </div>
  </main>

</template>

<script>

  import HomeSponsorizzati from './HomeSponsorizzati';

  export default {

    name: "HomeMain",

    components: {

      HomeSponsorizzati,

    },

    data() {
    
      return{
      
        specialtiesList: [],
        docsList: [],

      };
    
    },
    
    methods: {

        //ottengo tutte le specializzazioni
        getSpecialties() {
        
            axios.get('/api')
            .then((response) => {
              
              this.specialtiesList = response.data.results;

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
        
        },

        //ottengo tutti i dottori (PROVVISORIO)
        getDoctors() {
    
            axios.get('/api/docs')
            .then((response) => {
              
              this.docsList = response.data.results;
              console.log(this.docsList);

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
    
        },

    }, 

    mounted() {
        this.getSpecialties();

        this.getDoctors();
    }

  }

</script>

<style lang="scss" scoped>

  @import '../../sass/home/main.scss';

</style>