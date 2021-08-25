<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="row justify-content-center">
          <div class="col-md-12 mb-5 text-center">
            <h2 class="">
              សូមស្វាគមន៍ការចូលមកកាន់ K2 ឌីជីថល
            </h2>
          </div>

          <div class="col-md-12 mb-5 text-center" v-if="posts == ''">
            <div class="crop justify-content-center ">
                <img src="https://liferay-support.zendesk.com/hc/article_attachments/360032812612/no-web-content-found.png" alt="" srcset="">
            </div>
            <h4 class="mt-3">លោកអ្នកមិនទាន់មានការបង្ហោះអត្ថបទនៅឡើយទេ...</h4>
          </div>

          <div class="col-md-12 mb-5">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item mb-3" v-for="(post, i) in posts" :key="i">
                <div class="row">
                  <div class="dropdown">
                    <div>
                      <div class="user-info">
                        <div class="user-info__img">
                          <img :src="post.avatar != ''
                                ? post.avatar_base_url +'/'+ post.avatar
                                : post.avatar_base_url"
                            class="rounded-100 mx-auto d-block" alt="User Image" />
                        </div>
                        <div class="user-info__basic ml-3">
                          <h6 class="mb-0">{{ post.creater }}</h6>
                          <p class="text-dark text-small mb-0">
                            <i :class="
                                post.created_at != post.updated_at
                                  ? 'bi bi-pen'
                                  : ''
                              "></i>
                            {{
                            post.created_at != post.updated_at
                            ? post.updated_at
                            : post.created_at
                            }}
                          </p>
                          <span :class="
                              post.privacy
                                ? 'badge badge-primary mb-2'
                                : 'badge badge-danger mb-2'
                            ">
                            {{
                            post.privacy ? "សាធារណៈ" : "ឃើញតែខ្ញុំឯងប៉ុណ្ណោះ"
                            }}
                          </span>
                        </div>
                        <div class="btn-group dropstart open pull-right" v-if="post.creater_id == auth.id">
                          <span class="btn btn-defualt dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-dark"></i>
                          </span>
                          <ul class="dropdown-menu">
                            <li>
                              <a class="dropdown-item text-small" href="#"
                              @click.prevent="toggleModalConfirmEdit('EditPost',post.id,'កែប្រែអត្ថបទ',post.post,post.privacy)">
                              <i class="bi bi-pencil"></i> កែប្រែអត្ថបទ
                              </a>
                            </li>
                            <li><a class="dropdown-item text-danger text-small" href="#" @click.prevent="toggleModalConfirmDelete('post',post.id,'លុបអត្ថបទ','តើលោកអ្នកចង់លុបអត្ថបទរបស់ខ្លួនមែនទេ ?')"><i class="bi bi-trash"></i>
                                លុបចោលអត្ថបទ</a></li>
                          </ul>
                        </div>
                      </div>
                      <read-more class="mb-3 text-break" more-str="អាន​បន្ថែម" :text="post.post" link="#" less-str="អានតិច"
                        :max-chars="360"></read-more>
                    </div>
                  </div>
                </div>
                <div class="accordion-header" :id="'flush-headingOne' + i">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="accordion-button btn btn-default text-small">
                      <i class="bi bi-heart me-2"></i> {{ post.likes }} ចូលចិត្ត
                    </button>
                    <button type="button" @click.prevent="onClickComments(post.id)" class="
                        accordion-button
                        collapsed
                        btn btn-default
                        text-small
                      " data-bs-toggle="collapse" :data-bs-target="'#flush-collapseOne' + i" aria-expanded="false"
                      :aria-controls="'flush-collapseOne' + i">
                      <i class="bi bi-chat-square me-2"></i>
                      {{ post.comments.length }} មតិយោបល់
                    </button>
                  </div>
                </div>
                <div :id="'flush-collapseOne' + i" class="accordion-collapse collapse" 
                  :aria-labelledby="'flush-headingOne' + i" data-bs-parent="#accordionFlushExample">
                  <form class="mb-3 mt-3" @submit.prevent="onClickSubmitComment(post.id)">
                    <textarea rows="3" v-model="comment" class="text-small form-control"></textarea>
                    <button type="submit" class="btn btn-sm btn-outline-app text-small mt-3">
                      មតិយោបល់
                    </button>
                  </form>
                  <div class="accordion-body" v-for="(comment, i) in comments" :key="i">
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img class="flex-shrink-0 me-3 rounded-circle" width="40px" height="40px" 
                          :src="comment.avatar != ''
                                ? comment.avatar_base_url +'/'+ comment.avatar
                                : comment.avatar_base_url"
                          alt="photo" />
                      </a>
                      <div class="media-body">
                        <p class="media-heading text-bold">
                          <strong>{{ comment.creater }}</strong>
                          <span class="text-small">
                            <small>បានចេញមតិនៅ​ {{ comment.created_at }}</small>
                          </span>
                          <span>
                            <div class="btn-group dropstart"  v-if="comment.creater_id == auth.id">
                              <span class="btn btn-defualt dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-three-dots-vertical text-dark"></i>
                              </span>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-small" href="#"
                                @click.prevent="toggleModalConfirmEdit('EditComment',comment.id,'កែប្រែមតិយោបល់',comment.comments,'')"
                                ><i class="bi bi-pencil"></i> កែប្រែមតិ</a>
                                </li>
                                <li><a class="dropdown-item text-danger text-small" href="#"
                                @click.prevent="toggleModalConfirmDelete('comment',comment.id,'លុបមតិយោបល់','តើលោកអ្នកចង់លុបមតិយោបល់របស់ខ្លួនមែនទេ ?')"><i class="bi bi-trash"></i>
                                    លុបចោលមតិ</a></li>
                              </ul>
                            </div>
                          </span>
                        </p>
                        <read-more class="mb-3 text-break" more-str="អាន​បន្ថែម" :text="comment.comments" link="#"
                          less-str="អានតិច" :max-chars="130"></read-more>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div
                  class="modal fade"
                  id="toggleModalEdit"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ modalTitleText }}</h5>
                        <button
                          type="button"
                          class="close"
                          @click.prevent="closeModal"
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="md-3" v-if="modalType == 'EditPost'">
                          <label for="">ឯកជនភាព</label>
                          <select class="form-control text-small" v-model="modalPrivary">
                            <option value="0">ឃើញតែខ្ញុំឯងប៉ុណ្ណោះ</option>
                            <option value="1">សាធារណៈ</option>
                          </select>
                        </div>
                        <div class="md-3">
                          <label for="">{{ modalType == 'EditPost' ? 'អត្ថបទ' : 'មតិយោបល់' }}</label>
                          <textarea rows="5" v-model="modalBodyText" class="form-control text-small"></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-sm btn-app text-small"
                          @click.prevent="closeModal"
                        >
                          បោះបង់
                        </button>
                        <button type="button" class="btn btn-sm btn-primary-app text-small"
                        @click.prevent=" modalType == 'EditPost' ? onSubmitUpdatePost(modalId) : onSubmitUpdateComment(modalId)">
                          ធ្វើបច្ចុប្បន្នភាព
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div
                  ref="modal"
                  class="modal fade"
                  :class="{show, 'd-block': active}"
                  tabindex="-1"
                  role="dialog"
                >
                  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{ modalTitleText }}</h5>
                        <button
                          type="button"
                          class="close"
                          data-dismiss="modal"
                          aria-label="Close"
                          @click.prevent="toggleModalConfirmDelete"
                        >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{ modalBodyText }}</p>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-sm btn-danger text-small"
                          data-dismiss="modal"
                          @click.prevent="toggleModalConfirmDelete"
                        >
                          បោះបង់
                        </button>
                        <button
                          type="button"
                          data-dismiss="modal"

                          @click.prevent=" modalType == 'post' ? onClickDeletePost(modalId) : onClickDeleteComment(modalId)"
                          class="btn btn-sm btn-primary text-small"
                        >
                          បាទ ឬ ចាស
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
      </div>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from "vuex";
  export default {
    data() {
      return {
        showModel: false,
        isLoaded: true,
        imageLoadingURL:
          "https://cdn.iconscout.com/icon/free/png-512/person-with-laptop-male-1597386-1354342.png",
        imageURL: null,
        comment: "",
        active: false,
        show: false,
        privacy: 1,
        modalTitleText: '',
        modalBodyText: '',
        modalType: '',
        modalId: '',
        modalPrivary: '',
      };
    },
    computed: {
      ...mapGetters(["posts", "comments","auth"]),
    },
    created() {
      this.LoadPosts(),
      this.LoadComments(),
      this.Me()
    },
    methods: {
      ...mapActions([
        "LoadPosts",
        "LoadComments",
        "RemovePost",
        "UpdatePost",
        "AddNewComment",
        "FindCommentByPost",
        "RemoveComment",
        "UpdateComment",
        "Me"
      ]),
      onClickDeletePost(id) {
        this.RemovePost(id);
        this.LoadPosts();
        this.toggleModalConfirmDelete();
      },
      onClickDeleteComment(id) {
        let result = this.RemoveComment(id);
        result.then((result) => {
          console.log(result.data.id);
          this.toggleModalConfirmDelete();
          this.LoadComments();
          this.LoadPosts();
        })
      },
      onClicCloseEditPost() {
        this.LoadPosts();
      },
      onClickSubmit(id, post, privacy) {
        let data = {
          id: id,
          privacy: privacy,
          post: post,
        };
        this.UpdatePost(data);
      },
      onClickLikes() {
        console.log("Clicked like");
      },
      onClickComments(id) {
        this.comment = "";
        this.FindCommentByPost(id);
      },
      onSubmitUpdateComment(id)
      {
        console.info("onSubmitUpdateComment like "+id);
        let data = {
          id: id,
          comment: this.modalBodyText
        };
        this.UpdateComment(data);
        this.closeModal();
      },
      onSubmitUpdatePost(id){
        console.info("onSubmitUpdatePost like "+id);
        let data = {
          id: id,
          privacy: this.modalPrivary,
          post: this.modalBodyText
        };
        this.UpdatePost(data);
        this.closeModal();
      },
      onClickSubmitComment(id) {
        let data = {
          post_id: id,
          comment: this.comment,
        };
        this.AddNewComment(data);
        this.comment = "";
        this.LoadPosts();
        this.LoadComments();
      },
      toggleModalConfirmEdit(modalType,modalId,titleText,bodyText,privacy){
        this.modalTitleText = titleText;
        this.modalBodyText = bodyText;
        this.modalPrivary = privacy;
        this.modalType = modalType;
        this.modalId = modalId;
        $('#toggleModalEdit').modal('show')
      },
      toggleModalConfirmDelete(modalType,modalId,titleText,bodyText) {
        const body = document.querySelector("body");
        this.modalTitleText = titleText;
        this.modalBodyText = bodyText;
        this.modalType = modalType;
        this.modalId = modalId;
        this.active = !this.active;
        this.active
          ? body.classList.add("modal-open")
          : body.classList.remove("modal-open");
        setTimeout(() => (this.show = !this.show), 10);
      },
      closeModal(){
        $('#toggleModalEdit').modal('toggle')
      }
    },
  };
</script>
<style>
  .crop {
    height: 180px;
    overflow: hidden;
  }
  .crop img {
    width: 450px;
    height: 300px;
    margin: -51px 0 -51px -51px;
  }
</style>