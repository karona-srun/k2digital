<template>
  <div class="container mt-5">
    <h5>ព័ត៌មានរបស់គណនី</h5>
    <div class="jumbotron mt-2">
      <h5>កែប្រែព័ត៌មានរបស់គណនី</h5>
      <form class="form-floating">
        <div class="row">
          <div class="col">
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="last_name"
                v-model.trim="auth.last_name"
                placeholder="នាម"
                value="នាម"
              />
              <label for="floatingInputValue">ឈ្មោះគណនី</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="first_name"
                v-model.trim="auth.first_name"
                placeholder="នាមត្រកូល"
                value="នាមត្រកូល"
              />
              <label for="floatingInputValue">ឈ្មោះគណនី</label>
            </div>
          </div>
        </div>
        <div class="form-floating mb-2">
          <input
            type="email"
            class="form-control"
            id="email"
            placeholder="name@example.com"
            v-model.trim="auth.email"
            value="test@example.com"
          />
          <label for="floatingInputValue">អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល</label>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-floating mb-2">
              <input
                type="password"
                class="form-control"
                id="floatingInputValue"
                placeholder="ពាក្យសម្ងាត់"
                value="test@example.com"
              />
              <label for="floatingInputValue">ពាក្យសម្ងាត់</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-2">
              <input
                type="password"
                class="form-control"
                id="floatingInputValue"
                placeholder="បញ្ជាក់ពាក្យសម្ងាត់​ម្តង​ទៀត"
                value="test@example.com"
              />
              <label for="floatingInputValue">បញ្ជាក់ពាក្យសម្ងាត់​ម្តង​ទៀត</label>
            </div>
          </div>
        </div>

        <div class="form-floating mb-2">
          <input
            type="text"
            class="form-control"
            id="start_date"
            placeholder="កាលបរិច្ឆេទ"
            readonly
            value="31-08-2021 09:30 AM"
          />
          <label for="floatingInputValue">សមាជិកចាប់តាំងពី</label>
        </div>

        <div class="form-floating mb-2">
          <input
            type="email"
            class="form-control"
            id="end_date"
            placeholder="កាលបរិច្ឆេទ"
            readonly
            value="01-09-2021 09:30 AM"
          />
          <label for="floatingInputValue">កាលបរិច្ឆេទផុតកំណត់</label>
        </div>
        <div class="form-floating mb-2">
          <input
            type="text"
            class="form-control"
            id="plan"
            placeholder="គម្រោង"
            readonly
            value="BASIC"
          />
          <label for="floatingInputValue">ភ្ជាប់គម្រោង</label>
        </div>

        <button class="btn btn-primary mt-3">ធ្វើបច្ចុប្បន្នភាព</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  name: "Account",
  data() {
    return {

    };
  },
  computed: {
    auth: function () {
      return this.$store.getters.auth;
    },
  },
};
</script>