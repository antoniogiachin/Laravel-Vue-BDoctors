<template>
  <div>
      
      <div class="review">

          <div id="click-collapse" class="ms_row-info" data-bs-toggle="collapse" data-bs-target="#review-wrap" aria-expanded="false" aria-controls="review-wrap">
            <h3 @click="changeArrow()">Scrivi una recensione <i class="fa-solid" :class="(arrow === true)? 'fa-angle-down' : 'fa-angle-up' "></i></h3> 
          </div>

          <!-- FORM RECENSIONE -->
          <div class="collapse" id="review-wrap">

            <form @submit.prevent="sendReview">

              <!-- INIZIO VOTO -->
              <div id="star-vote" class="mb-3">
                <p>Da 1 a 5 come valuteresti la visita?</p>

                <input @click="goldStar(index)" v-for="(i, index) in 5" :key="i" type="radio" :id="'star' + i" name="vote" :value="i" v-model="voteValue">
                <label v-for="i in 5" :key="'a' + i" :for="'star' + i">
                  <i class="fa-star" :class="(i === goldStarValue)? 'fa-solid checked' : 'fa-regular' "></i>
                </label>

              </div>
              <!-- FINE VOTO -->

              <!-- TITOLO -->
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title" required placeholder="Scrivi un titolo per la recensione" v-model="title">
              </div>

              <!-- NOME AUTORE -->
              <div class="mb-3">
                <label for="name" class="form-label">Il tuo nome</label>
                <input type="text" class="form-control" id="name" name="author" required placeholder="Scrivi il tuo nome" v-model="name">
              </div>

              <!-- TESTO RECENSIONE -->
              <div class="mb-3">
                <label for="text-review" class="form-label">Scrivi la recensione</label>
                <textarea class="form-control" id="text-review" name="review" required rows="3" v-model="reviewText"></textarea>
              </div>
              
              <!-- BUTTON SUBMIT -->
              <button type="submit" class="btn btn-success text-white">Pubblica</button>


              <div v-if="success" class="alert alert-success mx-auto w-75 mt-4 p-2 text-center">
                  <i class="fa-solid fa-circle-check"></i> Recensione pubblicata!      
              </div>

            </form>

          </div>   

      </div>
  </div>
</template>

<script>

  export default {
    name: 'SingleDoctorReview',

    props: ['currentDoctor'],

    data() {
      return {
          arrow: true,

          voteValue: '',
          title: '',
          name: '',
          reviewText: '',
          goldStarValue: '',
          success: false,

      }
    },

    methods: {

      changeArrow() {
        this.arrow = !this.arrow;
      },

      goldStar(index) {
        this.goldStarValue = index + 1;
      },

      sendReview() {
      
        axios.post('/api/review', {

          'doctor_id': this.currentDoctor.id,
          'vote': this.voteValue,
          'title': this.title,
          'author': this.name,
          'review': this.reviewText,


        }).then(response =>{

            console.log(response);
            if (response.data.errors) {

              this.success = false;
              console.log(this.success);
            } else {

              this.success = true;
              this.voteValue = '',
              this.title = '',
              this.name = '',
              this.reviewText = '',
              this.goldStarValue = '',
              console.log(this.success);
            }
        
        });
      
      }
      
    }
  }

</script>

<style lang="scss" scoped>
  @import '../../sass/doctor/main.scss';
</style>