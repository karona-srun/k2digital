<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        ទំព័រ / Pages​ បង្ហោះជារូបភាព
        <button class="btn btn-primary float-right" @click.prevent="backPage">
          <i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ
        </button>
      </h5>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h5>បង្ហោះជារូបភាព</h5>
        <div class="form-floating mb-2 fix-floating-label"></div>

        <div
          id="my-strictly-unique-vue-upload-multiple-image"
          style="text-align: center"
        >
          <vue-upload-multiple-image
            @upload-success="uploadImageSuccess"
            @before-remove="beforeRemove"
            @edit-image="editImage"
            @data-change="dataChange"
            :max-image=200
            primary-text="លំនាំដើម"
            browse-text="ឬ រកមើលរូបភាព"
            drag-text="អូសរូបភាព"
            mark-is-primary-text="កំណត់ជាលំនាំដើម"
            popup-text="រូបភាពនេះនឹងត្រូវបានបង្ហាញជាលំនាំដើម"
            :multiple=true
            :show-edit=true
            :show-delete=true
            :show-add=true
          ></vue-upload-multiple-image>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import VueUploadMultipleImage from "vue-upload-multiple-image";
export default {
  components: {
    VueUploadMultipleImage,
  },
  props: {
    dragText: {
      type: String,
      default: "uuu",
    },
  },
  data() {
    return {
      images: [],
    };
  },
  created() {},
  methods: {
    backPage() {
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    },
    uploadImageSuccess(formData, index, fileList) {
      console.log("data", formData, index, fileList);
      // Upload image api
      // axios.post('http://your-url-upload', formData).then(response => {
      //   console.log(response)
      // })
    },
    beforeRemove(index, done, fileList) {
      console.log("index", index, fileList);
      var r = confirm("remove image");
      if (r == true) {
        done();
      } else {
      }
    },
    editImage(formData, index, fileList) {
      console.log("edit data", formData, index, fileList);
    },
    dataChange(formData, index, fileList) {
      console.log("edit data", formData, index, fileList);
    },
    markIsPrimary(index, fileList){
      console.log('markIsPrimary data', index, fileList)
    },
    limitExceeded(amount){
      console.log('limitExceeded data', amount)
    }
  },
};
</script>