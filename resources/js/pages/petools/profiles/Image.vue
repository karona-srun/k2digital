<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        គណនី / Profiles​ បង្ហោះជារូបភាព
        <button class="btn btn-primary float-right" @click.prevent="backPage">
          <i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ
        </button>
      </h5>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="shadow-none p-1 mb-5 bg-light rounded">
        <h5 class="pl-4">បង្ហោះជារូបភាព</h5>

        <div class="form-floating fix-floating-label form-custom">
          <textarea
            type="text"
            class="form-control"
            rows="10"
            v-model="text"
            placeholder="អត្ថបទ"
          ></textarea>
          <label for="floatingInputValue">អត្ថបទ</label>
        </div>

        <div class="form-floating fix-floating-label">
          <div class="row m-1">
            <label class="label-choose">ជ្រើសរើសរូបភាព</label>
            <div
              v-for="(data, index) in rawData"
              :key="index"
              class="image-input image-input-active d-flex"
            >
              <div class="image-preview">
                <img class="img-responsive h-100 img-preview" :src="data" />
                <button
                  class="btn btn-xs remove-file"
                  @click="removeFile(index)"
                >
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </div>

            <div
              class="image-input image-input-tbd d-flex"
              v-if="this.files.length < this.option.maxFileCount"
            >
              <div
                class="
                  image-preview
                  dropzone
                  d-flex
                  justify-content-center
                  align-items-center
                "
                @drop="loaddropfile"
                @click="openinput"
              >
                <i class="bi bi-plus-lg text-success"></i>
              </div>
              <input
                type="file"
                class="d-none"
                accept="image/*"
                id="vue-file-upload-input"
                @change="addImage"
              />
            </div>
          </div>
        </div>
        <div class="shadow-none p-3 mb-5 bg-light rounded">
          <button type="submit" class="btn btn-primary" @click="upload">
            យល់ព្រម <i class="bi bi-arrow-return-left"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      option: {
        maxFileCount: 300,
      },
      text: "",
      files: [],
      rawData: [],
    };
  },
  methods: {
    backPage() {
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    },
    onSubmit() {
      let data = {
        text: this.text,
        image: this.files
      }
      console.log(data);
    },
    loaddropfile: function (e) {
      e.preventDefault();
      e.stopPropagation();
      alert("ok");
      console.log(e);
    },
    openinput: function () {
      document.getElementById("vue-file-upload-input").click();
    },
    addImage: function (e) {
      const tmpFiles = e.target.files;
      if (tmpFiles.length === 0) {
        return false;
      }
      const file = tmpFiles[0];
      this.files.push(file);
      const self = this;
      const reader = new FileReader();
      reader.onload = function (e) {
        self.rawData.push(e.target.result);
      };
      reader.readAsDataURL(file);
    },
    removeFile: function (index) {
      this.files.splice(index, 1);
      this.rawData.splice(index, 1);
      document.getElementById("vue-file-upload-input").value = null;
    },
    upload: function () {
      alert("Check console to see uploads");
      console.log(this.files);
    },
  },
  mounted() {},
};
</script>
<style>
h2 {
  font-weight: bold;
  margin-bottom: 15px;
}

.m-1 {
  margin: -3px !important;
}
.form-custom {
  margin-bottom: -30px;
}

.label-choose {
  margin-left: -10px;
}
.image-input {
  padding: 3px;
  width: auto;
}

.image-preview {
  width: 96px;
  height: 96px;
  cursor: pointer;
  overflow: hidden;
}
.image-preview img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.img-preview {
  border-radius: 7%;
}
.dropzone {
  width: 96px;
  height: 96px;
}
.dropzone {
  border: 1px dashed green;
  border-radius: 7%;
}
.remove-file {
  position: absolute;
  margin-top: 5px;
  margin-left: -36px;
  color: rgba(0, 0, 0, 0.5);
  padding: 1px 6px;
  background-color: #f4f5f7;
}
.remove-file:hover {
  color: rgb(255, 255, 255);
  background-color: #d60000;
}
</style>