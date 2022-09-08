<template>
<div>
    <login v-if="!user"></login>

    <div class="d-flex justify-content-center flex-column align-items-center">
      <h2 v-if="user" class="px-3 py-3">Welcome {{user.name}}</h2>
    </div>

    <div class="d-flex container justify-content-center align-items-center w-100 ">
      <button v-if="user" class="btn btn-outline-success m-3 p-10" @click="reload">Home</button>
      <button v-if="user" class="btn btn-primary m-3 p-10" @click="showRegistration">Add Employee</button>
      <button v-if="user" class="btn btn-primary m-3 p-10" @click="showCreateDepartment">Department</button>
      <button v-if="user" class="btn btn-primary m-3 p-10" @click="showCreateEmployeeRecord">Create Employee Record</button>
      <button v-if="user" class="btn btn-outline-dark m-3 p-10" @click="logout">Logout</button>
    </div>
    
    <user v-if="user && !showRegister && !showAddRole && !showAddDepartment"></user>
    <user-create v-if="showRegister"></user-create>
    <role-create v-if="showAddRole && !showRegister"></role-create>
    <create-department v-if="showAddDepartment && !showAddRole && !showRegister"></create-department>
    <add-employee v-if="showAddEmployee &&!showAddDepartment && !showAddRole && !showRegister"></add-employee>
</div>
</template>
<script>
import RoleCreate from './RoleCreate.vue'
import User from './User.vue'
import UserCreate from './UserCreate.vue'
import CreateDepartment from './CreateDepartment';
import AddEmployee from './AddEmployee';
export default {
  components: { User, UserCreate, RoleCreate, CreateDepartment, AddEmployee},
  data(){
    return{
      user : null,
      showRegister: false,
      assignRoles: false,
      showAddRole: false,
      showAddDepartment: false,
      showAddEmployee: false
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
    },
    showCreateDepartment(){
      this.showRegister = false;
      this.showAddDepartment = true;
    },
    showCreateEmployeeRecord() {
      this.showRegister = false;
      this.showAddDepartment = false;
      this.showAddEmployee = true;
    }
  }
}
</script>