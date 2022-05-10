<template>
  <div>

    <HomeHeader :userChecked="userChecked" :authUser="authUser"></HomeHeader>
    <SingleDoctorMain :singledoc="singleDoc"></SingleDoctorMain>
    <HomeFooter></HomeFooter>

  </div>   
</template>

<script>

import HomeHeader from '../components/HomeHeader';
import SingleDoctorMain from '../components/SingleDoctorMain';
import HomeFooter from '../components/HomeFooter';

export default {
    name: "SingleDoctor",

    components: {
        HomeHeader,
        SingleDoctorMain,
        HomeFooter,
    },
    
    data() {
        return {

            singleDoc: [],

            authUser: window.authUser,
            userChecked: false,
          
        }
        
    },
    
    methods: {
        checkAuth() {
            if(this.authUser){
                this.userChecked = true;
            } else {
                this.userChecked = false;
            }

        },
        //ottengo il singolo dottore
        getDoctors() {

            const slug = this.$route.params.slug;

            axios.get('/api/doctors/' + slug)
            .then(response => {

            if(response.data.success == false) {
                abort(404, 'not found');

            } else {

                this.singleDoc = response.data.results;
                console.log(this.singleDoc);
                
            }
        })
      },

    },
    mounted() {

        this.checkAuth();

        this.getDoctors();
    }
}
</script>

<style>

</style>