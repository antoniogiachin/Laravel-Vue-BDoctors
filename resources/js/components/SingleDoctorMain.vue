<template>

  <main>
    <div id="doctor-container">
      <div id="top-color-row">

        <div class="container d-flex">

            <!-- FOTO -->
            <div class="doc-ph-wrap">
              <img :src="singledoc.photo" class="img-thumbnail" alt="foto dottore">
            </div>

            <!-- NOME e COGNOME -->
            <div id="doc-title">
              <h2 class="doc-name"> {{singledoc.user.name}} {{singledoc.user.surname}} </h2>
            </div>

        </div>

      </div>

      <!-- CONTAINER INFORMAZIONI -->
      <div class="container">

          <div id="info-container">
            <div id="col-doctor" class="row row-cols-1 row-cols-lg-2 justify-content-lg-between">

              <div id="col-info" class="col-lg-7">

                <div class="address ms_row-info">
                  <h3>Indirizzo</h3>
                  {{singledoc.medical_address}}
                </div>

                <div class="specialties ms_row-info">
                  <h3>Competenze</h3>
                  <ul class="spec-list">
                    <li v-for="(singlespec, index) in singledoc.specialties" :key="index">
                      {{singlespec.name}}
                    </li>
                  </ul>
                </div>

                <div class="performance ms_row-info">
                  <h3>Prestazioni</h3>
                  {{singledoc.performance}}
                </div>

                <div class="performance ms_row-info">
                  <h3>Curriculum</h3>
                  <a :href="singledoc.cv" target="_blank">Apri il Curriculum Vitae</a>
                </div>

                <!-- COMPONENT RECENSIONE -->
                <SingleDoctorReview></SingleDoctorReview>

                <!-- LISTA RECENSIONI -->
                <div class="performance ms_row-info">
                  <h3>Recensioni</h3>
                  <p>Recensione 1</p>
                  <p>Recensione 2</p>
                  <p>ecc...</p>
                </div>

              </div>

              <div id="col-booking" class="col-lg-4">
                <div class="booking-title">
                  <h2>Prenota un appuntamento</h2>
                </div>

                <div class="phone">
                    <h3>Telefono</h3>
                    {{singledoc.phone}}
                </div>

                <div class="message">
                    <h3>Scrivi un messaggio</h3>

                    <!-- FORM INVIO MESSAGGIO -->
                    <SingleDoctorForm></SingleDoctorForm>


                </div>
              </div>

            </div>
          </div>

      </div>

    </div>
  </main>

</template>

<script>

  import SingleDoctorReview from './SingleDoctorReview';
  import SingleDoctorForm from './SingleDoctorForm';

  export default {

    name: 'SingleDoctorMain',
    props: ['singledoc'],

    components: {

      SingleDoctorReview,
      SingleDoctorForm,
    
    },

  }

</script>

<style lang="scss" scoped>
  @import '../../sass/doctor/main.scss';
</style>