<template>
    <div class="container mb-3 mt-3">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            :class="currentTab == 1 ? 'nav-link active':'nav-link'"
            id="pills-home-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-home"
            type="button"
            role="tab"
            aria-controls="pills-home"
            :aria-selected="currentTab == 1 ? true : false"
            @click.prevent="selectedTab(1)"
          >
            គណនី / Profiles
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            :class="currentTab == 2 ? 'nav-link active':'nav-link'"
            id="pills-profile-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-profile"
            type="button"
            role="tab"
            aria-controls="pills-profile"
            :aria-selected="currentTab == 2 ? true : false"
            @click.prevent="selectedTab(2)"
          >
            ទំព័រ / Pages
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            :class="currentTab == 3 ? 'nav-link active':'nav-link'"
            id="pills-contact-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-contact"
            type="button"
            role="tab"
            aria-controls="pills-contact"
            :aria-selected=" currentTab == 3 ? true : false"
            @click.prevent="selectedTab(3)"
          >
            ក្រុម / Groups
          </button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div
          class="tab-pane fade"
          :class=" currentTab == 1 ? 'show active' : ''"
          id="pills-home"
          role="tabpanel"
          aria-labelledby="pills-home-tab"
        >
          <h5>បង្ហោះទៅកាន់គណនី</h5>
          <div class="row p-3 pb-1">
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    បង្ហោះជាអត្ថបទ ឬ តំណភ្ជាប់​ (Texts/Links)
                  </h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាអត្ថបទ ឬ តំណភ្ជាប់​ <i class="bi bi-file-text"></i> (Texts/Links) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button 
                    class="btn btn-primary"
                    @click.prevent="nextPage('/pe-tools/profile/post-text')"
                  >ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជារូបភាព​ (Pictures)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជារូបភាព <i class="bi bi-card-image"></i>​ (Pictures) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button 
                    class="btn btn-primary"
                    @click.prevent="nextPage('/pe-tools/profile/post-image')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជាវីដេអូ (Videos)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាវីដេអូ <i class="bi bi-camera-video"></i> (Videos) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button 
                    class="btn btn-primary"
                    @click.prevent="nextPage('/pe-tools/profile/post-video')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          :class=" currentTab == 2 ? 'show active' : ''"
          id="pills-profile"
          role="tabpanel"
          aria-labelledby="pills-profile-tab"
        >
          <h5>បង្ហោះទៅកាន់ទំព័រ</h5>
          <div class="row p-3 pb-5">
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    បង្ហោះជាអត្ថបទ ឬ តំណភ្ជាប់​ (Texts/Links)
                  </h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាអត្ថបទ ឬ តំណភ្ជាប់​ <i class="bi bi-file-text"></i> (Texts/Links) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary"
                  @click.prevent="nextPage('/pe-tools/page/post-text')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជារូបភាព​ (Pictures)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជារូបភាព <i class="bi bi-card-image"></i>​ (Pictures) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary" 
                  @click.prevent="nextPage('/pe-tools/page/post-image')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជាវីដេអូ (Videos)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាវីដេអូ <i class="bi bi-camera-video"></i> (Videos) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary"
                  @click.prevent="nextPage('/pe-tools/page/post-video')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          :class=" currentTab == 3 ? 'show active' : ''"
          id="pills-contact"
          role="tabpanel"
          aria-labelledby="pills-contact-tab"
        >
          <h5>បង្ហោះទៅកាន់ក្រុម</h5>
          <div class="row p-3 pb-5">
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    បង្ហោះជាអត្ថបទ ឬ តំណភ្ជាប់​ (Texts/Links)
                  </h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាអត្ថបទ ឬ តំណភ្ជាប់​ <i class="bi bi-file-text"></i> (Texts/Links) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary"
                  @click.prevent="nextPage('/pe-tools/group/post-text')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជារូបភាព​ (Pictures)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជារូបភាព <i class="bi bi-card-image"></i>​ (Pictures) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary"
                  @click.prevent="nextPage('/pe-tools/group/post-image')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">បង្ហោះជាវីដេអូ (Videos)</h6>
                  <p class="card-text mb-2">
                    មុខងារនេះសម្រាប់ការបង្ហោះលក្ខណៈជាវីដេអូ <i class="bi bi-camera-video"></i> (Videos) ទៅកាន់គណនីរបស់អ្នក។
                  </p>
                  <button class="btn btn-primary"
                  @click.prevent="nextPage('/pe-tools/group/post-video')">ចាប់ផ្តើម <i class="bi bi-arrow-return-left"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      currentTab: '',
    }
  },
  created() {
    this.currentTab = localStorage.currentTab;
  },

  methods: {
    selectedTab(index){
      localStorage.currentTab = index;
    },
    nextPage(slug){
      this.$nextTick(() => {
        this.$router.push(slug);
      });
    }
  }
}
</script>