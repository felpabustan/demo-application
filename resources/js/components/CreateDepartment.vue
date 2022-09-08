<template>
  <div class="py-3 justify-content-center flex-column align-items-center">
    <div class="py-3 justify-content-center flex-column align-items-center" v-if="showCreateRole">
      <form @submit.prevent="addDepartment()">
        <div class="container w-25">
          <div class="col py-3">
            <label for="departmentName">Department Name</label>
            <input type="text" id="departmentName" v-model="department_name" class="form-control" :class="{'is-invalid': errors.department_name.length}" placeholder="Role Name">
            <div class="invalid-feedback" v-for="(error, index) in errors.department_name" :key="index">
              {{ error }}
            </div>
          </div>
          <div class="col py-3">
            <label for="roleDescription">Role Name</label>
            <input type="text" id="departmentDescription" v-model="description" class="form-control" :class="{'is-invalid': errors.description.length}" placeholder="Description">
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
          <th scope="col">Department Name</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="department in departments.data" :key="department.id"
        >
          <td>{{ department.deparment_name }}</td>
          <td>{{ department.description }}</td>
          <td>
            <button class="btn btn-primary" @click="editDepartment(department)">edit</button>
            <button class="btn btn-danger" @click="deleteDepartment(department)">delete</button>
          </td>
        </tr>
        </tbody>
      </table>
      <button class="btn btn-secondary" @click="showCreateForm">Create New Department</button>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      departments:{
        data:[]
      },
      errors:{
        role_name:[],
        description:[]
      },
      department_name: "",
      description: "",
      showEditor: false,
      showDepartmentTable: false,
      showCreateDepartment: false,
      currentDepartment: null
    }
  },
  mounted(){
    this.getDepartments();
  },
  methods:{
    addRole(){
      axios.post('/api/roles', {
        department_name: this.department_name,
        description: this.description
      }).then((response)=>{
        alert('Role created successfully')
      }).then((response)=>{
        location.reload()
      }).catch((err)=>{
        let e = err.response.data
        this.errors.role_name = e.role_name ? e.role_name : []
        this.errors.description = e.role_name ? e.role_name :[]
      })
    },
    editDepartment(department){
      this.showCreateDepartment = true
      this.department_name = department.department_name
      this.description = department.description
    },
    deleteDepartment(department){
      axios.delete(`/api/departments/${department.id}`).then((response)=>{
        this.getDepartments()
        alert('Department deleted.')
      })
    },
    showTable(){
      this.showDepartmentTable = true
    },
    showCreateForm(){
      this.showCreateDepartment = true
      this.department_name = ""
      this.description = ""
    },
    getDepartments(){
      axios.get('/api/departments').then((response) =>{
        this.departments = response.data;
      })
    },
  }
}
</script>