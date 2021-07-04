<template>
    <div class="container mt-sm-5 my-3 bg-light rounded p-4">
        <div class="spinner-overlay" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                ข้อมูลผู้สมัคร
            </legend>
            <div class="p-3">
                <form class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="firstname"
                                >ชื่อ (ไม่ต้องมีคำนำหน้า)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="firstname"
                                v-model="feedback.student.firstname"
                                required
                            />
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname">นามสกุล</label>
                            <input
                                type="text"
                                class="form-control"
                                id="lastname"
                                v-model="feedback.student.lastname"
                                required
                            />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="stdid">รหัสนักศึกษา (มีขีด -)</label>
                            <input
                                type="text"
                                placeholder="xxxxxxxxxxxx-x"
                                class="form-control"
                                id="stdid"
                                v-model="feedback.student.stdid"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="bracnh">สาขา</label>
                            <input
                                type="text"
                                class="form-control"
                                id="bracnh"
                                v-model="feedback.student.branch"
                                required
                            />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="faculty">คณะ</label>
                            <input
                                type="text"
                                class="form-control"
                                id="faculty"
                                v-model="feedback.student.faculty"
                                required
                            />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="phone">เบอร์ติดต่อ</label>
                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                v-model="feedback.student.phone"
                                required
                            />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="level">ชั้นปี</label>
                            <select
                                class="custom-select"
                                id="level"
                                v-model="feedback.student.level"
                                required
                            >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">
                แบบสอบถาม ({{ club_name }})
            </legend>

            <div
                class=" ml-sm-5 pl-sm-5 pt-2"
                v-for="(question, idx) in questions"
                :key="question.id"
            >
                <div class="py-2 h5">
                    <b>{{ idx + 1 }}. {{ question.question }}</b>
                </div>

                <div
                    class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3"
                    id="options"
                    v-for="answer in question.answers"
                    :key="answer.id"
                >
                    <div class="custom-control custom-radio">
                        <input
                            class="custom-control-input"
                            type="radio"
                            :name="`input_${question.id}`"
                            :id="`radio_${answer.id}`"
                            @input="updateFeedback($event, idx, question.id)"
                            :value="answer.answer"
                        />
                        <label
                            class="custom-control-label"
                            :for="`radio_${answer.id}`"
                            >{{ answer.answer }}</label
                        >
                    </div>
                </div>
                <small v-if="feedback.feedback[idx].invalid" class="text-danger"
                    >ยังไม่ได้ตอบ</small
                >
                <hr />
            </div>
        </fieldset>

        <div class="d-flex align-items-center pt-3">
            <div class="ml-auto mr-sm-5">
                <button class="btn btn-success" @click="submit()">
                    ส่งคำตอบ
                </button>
            </div>
        </div>
    </div>
</template>
<style>
@import url("https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500;600&display=swap");
.spinner-overlay {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100%;
    z-index: 1050;
    background: rgba(255, 255, 255, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
}

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    width: inherit; /* Or auto */
    padding: 0 10px; /* To give a bit of padding on the left and right */
    border-bottom: none;
}
</style>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
    props: ["success", "question", "save", "token", "club"],
    data: function() {
        return {
            questions: [],
            title: "test",
            feedback: {
                student: { level: 1 },
                feedback: []
            },
            loading: false,
            valid: false,
            club_name: "",
            club_id: this.club
        };
    },
    mounted() {
        this.loading = true;
        axios
            .get(`${this.question}/${this.club_id}`)
            .then(response => {
                this.questions = response.data.data;
                this.responseError();
                this.club_name = response.data.club_name;
                document.title = `การตอบกลับ (${this.club_name})`;
                this.loading = false;
            })
            .catch(e => console.log(e));
    },
    methods: {
        submit() {
            if (this.checkLength() < this.questions.length) {
                this.responseError();
            }
            if (!this.studentValid()) {
                Swal.fire({
                    icon: "error",
                    title: "โอ๊ะ!...",
                    text: "กรอกข้อมูลผู้สมัครให้ครับถ้วน"
                });
                return;
            }
            if (!this.valid) {
                this.loading = true;
                Swal.fire({
                    icon: "error",
                    title: "โอ๊ะ!...",
                    text: "ยังตอบคำถามไม่ครบ"
                });
                this.loading = false;
                return;
            }
            this.loading = true;
            this.feedback.token = this.token;
            axios
                .post(`${this.save}/${this.club_id}`, this.feedback)
                .then(response => {
                    console.log(response.data);
                    this.loading = false;
                    window.location = this.$props.success;
                }).catch(e=>console.log(e));
        },
        updateFeedback(e, id, qid) {
            this.loading = true;
            this.feedback.feedback[id] = {
                answer: e.target.value,
                question_id: qid
            };
            this.$set(this.feedback.feedback[id], "invalid", false);
            this.$set(this.feedback.feedback[id], "club_id", this.club_id);
            this.loading = false;
        },
        checkLength() {
            let i;
            let length = 0;
            for (i = 0; i < this.questions.length; i++) {
                if (this.feedback.feedback[i].invalid === false) {
                    length++;
                }
            }
            if (length == this.questions.length) {
                this.valid = true;
            }
            return length;
        },
        responseError() {
            let i;
            for (i = 0; i < this.questions.length; i++) {
                if (this.feedback.feedback[i] === undefined) {
                    this.feedback.feedback[i] = { invalid: true };
                }
            }
        },
        studentValid() {
            if (
                this.isEmpty(this.feedback.student.firstname) ||
                this.isEmpty(this.feedback.student.lastname) ||
                this.isEmpty(this.feedback.student.stdid) ||
                this.isEmpty(this.feedback.student.branch) ||
                this.isEmpty(this.feedback.student.faculty) ||
                this.isEmpty(this.feedback.student.phone) ||
                this.isEmpty(this.feedback.student.level)
            ) {
                return false;
            }
            return true;
        },
        isEmpty(valid) {
            if (valid === undefined || valid === null || valid === "") {
                return true;
            }
            return false;
        }
    },
    computed: {}
};
</script>
