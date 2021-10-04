<template>
   <div class="mt-2">
    <div class="p-2">
      <h5 class="text-primary">
        ទំព័រ / Pages
        <button class="btn btn-primary float-right" @click.prevent="backPage"><i class="bi bi-backspace-fill"></i> ត្រឡប់ថតក្រោយ</button>
      </h5>
    </div>
    <form @submit.prevent="">
    </form>
  </div>
</template>
<script>
export default {
  methods: {
    backPage(){
      this.$nextTick(() => {
        this.$router.push("/pe-tools");
      });
    }
  }
};
</script>