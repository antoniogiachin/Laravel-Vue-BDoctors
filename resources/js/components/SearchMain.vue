<template>
  <main>

    
        <div id="jumbotron">
            <form>

            <div class="row justify-content-center px-2">

                
                <div id="spec-wrap" class="col-12 col-lg-9 px-3 py-4 px-lg-4 py-lg-4">

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8 mb-2 mb-lg-0">
                            <input type="text" class="form-control" placeholder="Cerca il tuo medico" v-model="ricerca" @input="docFilter">
                        </div>

                        <div class="col-12 col-lg-4">
                        <button type="submit" class="btn-specialty btn p-2">Cerca</button>
                        </div>

                    </div>

                </div>

            </div>

            </form>
        </div>
        
    



    <div id="container" class="col-12 p-4 p-lg-4">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 gx-4 gy-4 gx-lg-5 gy-lg-5 m_col-card">

            <!-- CARD 1 -->
            <div class="col" v-for="doctor in filteredDoctors" :key="doctor.id">
                <div class="card h-100">

                    <img :src="doctor.photo" class="card-img-top">

                    <div class="card-body">
                    
                    <!-- NOME E COGNOME -->
                    <h5 class="card-title">
                        {{doctor.user.name}} {{doctor.user.surname}}
                    </h5>
                    <ul class="spec-list">
                        <!-- SPECIALTIES -->
                        <li v-for="(specName, index) in doctor.specialties" :key="index">
                            {{specName.name}}
                        </li>
                    </ul>
                    <!-- INDIRIZZO -->
                    <p class="card-text">{{doctor.medical_address}}</p>

                    <!-- LINK PROFILO DOTTORE -->
                    <a href="#" class="btn btn-primary text-white">Vai al profilo</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
</template>

<script>
export default {
    name: 'SearchMain',

    data() {
        return {

            doctors: [],
            filteredDoctors: [],
            ricerca: '',
            doc: '',
            filter: '',
        }
    },

    methods: {

        getDoctors() {
    
            axios.get('/api/docs')
            .then((response) => {
              console.log(response)
              this.doctors = response.data.results;
              this.filteredDoctors = response.data.results;

              console.log(this.doctors);

            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
    
        },

        docFilter() {  //utilizzando il contenuto della barra di ricerca filtra i dottori
                
            this.filteredDoctors = []

            for (let i = 0; i < this.doctors.length; i++) {
                this.doc = this.doctors[i].slug;
                this.filter = this.ricerca.toLowerCase().replace(' ', '-');
                
                
                if (this.filter != '' && this.doc.includes(this.filter)) {
                    
                    this.filteredDoctors.push(this.doctors[i])

                } else if (!this.filter) {
                    
                    for (let i = 0; i < this.doctors.length; i++) {

                        if (this.filteredDoctors.length < this.doctors.length) {

                            this.filteredDoctors.push(this.doctors[i])
                        }
                     
                    }
                }
            }
        }

        
    },

    mounted() {
        this.getDoctors();
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/home/main.scss';
</style>