<template>
    <div
      class="modal fade"
      id="toggleModalEditPost"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">កែប្រែអត្ថបទ {‌{project}} </h5>
            <button
              type="button"
              class="close"
              @click.prevent="close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="md-3">
              <label for="">ឯកជនភាព</label>
              <select class="form-control text-small" v-model="privacy">
                <option value="0">ឃើញតែខ្ញុំឯងប៉ុណ្ណោះ</option>
                <option value="1">សាធារណៈ</option>
              </select>
            </div>
            <div class="md-3">
              <label for="">អត្ថបទ</label>
              <textarea rows="5" v-model="post" class="form-control text-small"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-sm btn-app text-small"
              @click.prevent="close"
            >
              បោះបង់
            </button>
            <button type="button" class="btn btn-sm btn-primary-app text-small">
              ធ្វើបច្ចុប្បន្នភាព
            </button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import eventBus from '../event-bus.js';
export default {
  props: {project : {
    type: Object
  }},
  data() {
    return {
      post: '', 
      privacy: 1
    }
  },

  created(){
  eventBus.$on('toggleModalEditPost', (item) => {
    console.log('bus data: ', item)
  })  
}
}
</script>
