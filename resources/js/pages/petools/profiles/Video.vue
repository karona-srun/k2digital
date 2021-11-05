<template>
  <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        គណនី / Profiles​ បង្ហោះជាវីដេអូ
        <button class="btn btn-primary float-right" @click.prevent="backPage">
          <i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ
        </button>
      </h5>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="shadow-none p-3 mb-5 bg-light rounded">
        <h5>បង្ហោះជាវីដេអូ</h5>
        <div class="form-floating mb-2 fix-floating-label"></div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
    data() {
        return{ }
    },
    methods: {
        backPage() {
            this.$nextTick(() => {
                this.$router.push("/pe-tools");
            });
        }
    }
}
</script>