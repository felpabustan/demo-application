<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <div class="py-3 justify-content-center flex-column align-items-center" v-if="showCreateRole">
      <form @submit.prevent="addRole()">
        <div class="container w-25">
          <div class="col py-3">
            <label for="roleName">Role Name</label>
            <input type="text" id="roleName" v-model="role_name" class="form-control" :class="{'is-invalid': errors.role_name.length}" placeholder="Role Name">
            <div class="invalid-feedback" v-for="(error, index) in errors.role_name" :key="index">
              {{ error }}
            </div>
          </div>
          <div class="col py-3">
            <label for="roleDescription">Role Name</label>
            <input type="text" id="roleDescription" v-model="description" class="form-control" :class="{'is-invalid': errors.description.length}" placeholder="Description">
            <div class="invalid-feedback" v-for="(error, index) in errors.description" :key="index">
              {{ error }}
            </div>
          </div>
          <div class="col py-3">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center w-30">
        <table class="table w-50">
          <thead>
            <tr>
              <th scope="col">Role Name</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="role in roles.data" :key="role.id"
            >
              <td>{{ role.role_name }}</td>
              <td>{{ role.description }}</td>
              <td>
                <button class="btn btn-primary" @click="editRole(role)">edit</button>
                <button class="btn btn-danger" @click="deleteRole(role)">delete</button>
              </td>
            </tr>
          </tbody>
        </table>
        <button class="btn btn-secondary" @click="showCreateForm">Create New Role</button>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      roles:{
        data:[]
      },
      errors:{
        role_name:[],
        description:[]
      },
      role_name: "",
      description: "",
      showEditor: false,
      showRoleTable: false,
      showCreateRole: false,
      currentRole: null
    }
  },
  mounted(){
    this.getRoles();
  },
  methods:{
    addRole(){
      axios.post('/api/roles', {
        role_name: this.role_name,
        description: this.description
      }).then((response)=>{
        console.log(response);
      }).then((response)=>{
        alert('Role created successfully')
      }).then((response)=>{
        location.reload()
      }).catch((err)=>{
        console.log(err.response.data)
        let e = err.response.data
        this.errors.role_name = e.role_name ? e.role_name : []
        this.errors.description = e.role_name ? e.role_name :[]
      })
    },
    editRole(role){
      this.showCreateRole = true
      this.role_name = role.role_name
      this.description = role.description
    },
    deleteRole(role){
      axios.delete(`/api/roles/${role.id}`).then((response)=>{
        this.getRoles()
        alert('Role deleted.')
      })
    },
    showTable(){
      this.showRoletable = true
    },
    showCreateForm(){
      this.showCreateRole = true
      this.role_name = ""
      this.description = ""
    },
    getRoles(){
      axios.get('/api/roles').then((response) =>{
        console.log(response.data)
        this.roles = response.data;
      })
    },
  }
}
</script>