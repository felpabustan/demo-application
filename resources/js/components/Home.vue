<template>
<div>
    <login v-if="!user"></login>

    <div class="d-flex justify-content-center flex-column align-items-center">
      <h3 v-if="user" class="px-3 py-3">Welcome {{user.name}}</h3>
    </div>

    <div class="d-flex container justify-content-center align-items-center w-100">
      <button v-if="user" class="btn btn-secondary m-3 p-10" @click="reload">Home</button>
      <button v-if="user" class="btn btn-primary m-3 p-10" @click="showRegistration">Register User</button>
      <button v-if="user" class="btn btn-primary m-3 p-10" @click="showCreateRole">Roles</button>
      <button v-if="user" class="btn btn-secondary m-3 p-10" @click="logout">Logout</button>
    </div>
    
    <user v-if="user && !showRegister && !showAddRole"></user>
    <user-create v-if="showRegister"></user-create>
    <role-create v-if="showAddRole && !showRegister"></role-create>
</div>
</template>
<script>
import RoleCreate from './RoleCreate.vue'
import User from './User.vue'
import UserCreate from './UserCreate.vue'
export default {
  components: { User, UserCreate, RoleCreate },
  data(){
    return{
      user : null,
      showRegister: false,
      assignRoles: false,
      showAddRole: false
    }
  },
  mounted(){
    this.getUser()
  },
  methods:{
    logout(){
      axios.post('/logout').then(response => {
        console.log(response)
        location.reload()
        this.showRegister = false
      })
    },
    getUser(){
      axios.get('/api/user').then(response=> {
        this.user = response.data
      })
    },
    showRegistration(){
      this.showRegister = true
    },
    reload(){
      location.reload();
    },
    showCreateRole(){
      this.showAddRole = true;
      this.showRegister = false;
    }
  }
}
</script>