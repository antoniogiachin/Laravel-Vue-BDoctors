<template>
    <main>

        <div>
            <div id="jumbotron">
                <form>

                    <div class="row row-no-gutter justify-content-center px-2">

                        
                        <div id="spec-wrap" class="col-12 col-lg-9 px-3 py-4 px-lg-4 py-lg-4">

                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-9 mb-2 mb-lg-0">
                                    <input type="text" class="form-control" placeholder="Cerca il tuo medico" v-model="ricerca" @input="docFilter">
                                </div>

                                <div class="col-12 col-lg-3">

                                    <button class="btn btn-specialty" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filtri</button>
                                </div>
                            </div> 
                        </div>    
                        <div>
                            <div class="my-offcanvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Try scrolling the rest of the page to see this option in action.</p>
                                </div>
                            </div>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Offcanvas with backdrop</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>.....</p>
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
                            <router-link class="btn btn-primary text-white" :to="'/doctors/' + doctor.slug">Vai al profilo</router-link>

                            </div>
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
                this.doc = this.doctors[i].slug.replace('-', '');
                this.filter = this.ricerca.toLowerCase().replace(' ', '');
                
                
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

.filter-item {
    width: 50%;

    p {
        display: inline-block;
        
    }
}
.show {
    display: flex;
    align-items: center;
}

.collapse-horizontal {

    max-height: 52px;
}

.row-no-gutter {
    --bs-gutter-x: 0;
}

.my-offcanvas {
    z-index: 0;
    position: relative;
    
}
</style>