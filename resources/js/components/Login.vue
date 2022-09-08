<template>
<div class="container w-30 px-3 py-5 align-items-center" style="width: 500px;">
  <h4>ipsum<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <circle cx="8" cy="15" r="4"></circle>
    <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
    <line x1="18" y1="5" x2="20" y2="7"></line>
    <line x1="15" y1="8" x2="17" y2="10"></line>
  </svg></h4>
  <form @submit.prevent="login">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid': errors.email.length}" id="exampleInputEmail1" required>
      <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
        {{ error }}
      </div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input v-model="form.password" type="password" class="form-control" :class="{'is-invalid': errors.password.length}" id="exampleInputPassword1" required>
      <div class="invalid-feedback" v-for="(error, index) in errors.password" :key="index">
        {{ error }}
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</template>
<script>
export default {
  data(){
    return{
      form : {
        email : "",
        password : ""
      },
      errors:{
        email: [],
        password: []
      }
    }
  },
  methods:{
    login(){
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', this.form).then(response =>{
          location.reload()
        }).catch((err)=>{
          console.log(err.response.data)
          let e = err.response.data.errors
          this.errors.email = e.email ? e.email : []
          this.errors.password = e.password ? e.password : []
        })
      });
    }
  }
}
</script>