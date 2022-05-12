<template>
    <main>

        <div>
            <div id="jumbotron" class="position-relative">
                <form>
                    <div class="row row-no-gutter justify-content-center px-2">


                        <div id="spec-wrap" class="col-12 col-lg-9 px-3 py-4 px-lg-4 py-lg-4 d-inline">

                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-9 mb-2 mb-lg-0">
                                    <input type="text" class="form-control" placeholder="Digita il nome del medico" v-model="ricerca" >
                                </div>

                                <div class="col-12 col-lg-3">

                                    <button class="btn btn-specialty" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                        Filtri
                                    </button>

                            </div>
                            </div>
                        </div>
                        <div class="d-inline collapse-container">


                            <div class="collapse collapse-horizontal my-collapse" id="collapseWidthExample">
                                <div class="card card-body">
                                    Media voto:
                                    <ul class="d-flex flex-wrap filters-list">
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input v-model="checkedReview" class="form-check-input" type="checkbox" value="5" id="flexCheckDefault" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">5 <i class="fa-solid fa-star"></i></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input v-model="checkedReview" class="form-check-input" type="checkbox" value="4" id="flexCheckDefault" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">4+ <i class="fa-solid fa-star"></i></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input v-model="checkedReview" class="form-check-input" type="checkbox" value="3" id="flexCheckDefault" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">3+ <i class="fa-solid fa-star"></i></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input v-model="checkedReview" class="form-check-input" type="checkbox" value="2" id="flexCheckDefault" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">2+ <i class="fa-solid fa-star"></i></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input v-model="checkedReview" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">1+ <i class="fa-solid fa-star"></i></span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                    Numero di recensioni:
                                    <ul class="d-flex flex-wrap filters-list">
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">> 10</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">5 - 10</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="ms-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <span class="rating-stars">&lt; 5</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>




                    </div>
                    <div class="row row-no-gutter justify-content-center px-2">

                        <SelectSpecialty :specialtiesList="specialtiesList" class="mt-4"/>
                    </div>
                </form>
            </div>





            <div id="container" class="col-12 p-4 p-lg-4 container">

                <div class="row">
                    <div class="col my-3">
                        <h2>Ecco tutti i dottori specializzati in <span class="text-capitalize text-danger">{{ $route.params.slug
                            }}</span></h2>
                    </div>
                </div>
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
import SelectSpecialty from '../components/SelectSpecialty';
export default {
    name: 'SearchMain',
    components: { SelectSpecialty },
    data() {
        return {
            doctors: [],
            ricerca: '',
            specialtiesList: [],
            checkedReview : [],
        }
    },

    methods: {

        getDoctors() {

            axios.get("/api/docs/" + this.$route.params.slug)
                .then((response) => {
                    console.log(response);
                    this.doctors = response.data.results;
                    console.log(this.doctors);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });

        },

        //ottengo tutte le specializzazioni
        getSpecialties() {

            axios.get("/api")
                .then((response) => {

                    this.specialtiesList = response.data.results;

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });

        },
        // dottori per media voti
        doctorsByVote(){
            this.doctors = [];
            if(this.checkedReview.length > 0){
                this.checkedReview.forEach(check =>{
                    axios.get("/api/doctors/filter/" + check)
                        .then(res => {
                            console.log(this.doctors);
                            res.data.results.forEach(doctor=>{
                                this.doctors.push(doctor);
                            });
                            console.log(res.data);
                        });
                })
            } else {
                this.getDoctors();
            }
        }
    },

    mounted() {
        // this.getDoctors();
        this.getSpecialties();
    },
    computed:{
        filteredDoctors: function(){
            return this.doctors.filter(doc =>{
                let query = this.ricerca.toLowerCase().replaceAll(' ', "");
                if(this.$route.params.slug != ''){
                    return !!doc.specialties.some(specialty => specialty.slug === this.$route.params.slug && doc.slug.replaceAll("-", '').includes(query));
                } else{
                    return doc.slug.replaceAll("-", '').includes(query);
                }
            })
        }
    },
    watch:{
        checkedReview: {
            immediate: true,
            handler: 'doctorsByVote',
        }
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

.collapse-container {

    width: fit-content;
    height: fit-content;
    z-index: 2;
    height: 101%;
    margin-top: 17px;

    .my-collapse {

        width: 250px;
    }
}

.filters-list {
    list-style-type: none;
    font-size: 12px;
}
.rating-stars i {
    color: gold;
}

</style>
