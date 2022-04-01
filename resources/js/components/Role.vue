<template>
   <div class="d-flex justify-content-center flex-column align-items-center">
    <table class="table w-25">
      <thead>
        <tr>
          <th scope="col">Role Name</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>role name</td>
          <td>role description</td>
          <td>
            <button class="btn btn-primary">edit</button>
            <button class="btn btn-danger">delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
   data(){
    return{
      roles: {
        data:[]
      }
    }
  },
  mounted(){
    this.getRoles();
  },
  methods:{
    getRoles(){
      axios.get("/api/roles").then((response) => {
        this.roles = response.data
      })
    }
  }
}
</script>