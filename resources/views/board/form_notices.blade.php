@extends('layouts.frames.master')
@section('content')
<section class="register-section">
    <table class="table table-register">
        <tbody>
        <tr>
            <th>
                <label class="label">도시</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select"
                            id="MetroID"
                            name="MetroID"
                            v-model="form.MetroID">
                            <option value="">전체</option>
                            @foreach ($MetroList as $Metro)
                                <option value="{{ $Metro->MetroID }}">{{ $Metro->MetroName }}</option>
                            @endforeach
                    </select>
                </div>
            </td>
            <th>
                <label class="label">지역(순회구)</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select @error('CircuitID') is-invalid @enderror"
                        id="CircuitID"
                        name="CircuitID"
                        v-model="form.CircuitID">
                        <option value="">전체</option>
                        <option v-for="Circuit in CircuitList"
                            :value="Circuit.CircuitID">@{{ Circuit.CircuitName }}</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">열람대상선택</label>
            </th>
            <td>
                <div class="inline-responsive">
                    <select class="custom-select"
                        :class="{'is-invalid': validation.ReceiveGroupID}"
                        v-model="form.ReceiveGroupID">
                        <option value="">선택</option>
                        @foreach ($ReceiveGroupList as $ReceiveGroup)
                            <option value="{{ $ReceiveGroup->ID }}">{{ $ReceiveGroup->Item }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" v-if="validation.ReceiveGroupID">@{{ validation.ReceiveGroupID[0] }}</div>
                </div>
            </td>
            <th>
                <label class="label">화면표시여부</label>
            </th>
            <td>
            <div class="inline-responsive">
                <div class="check-group inline-responsive">
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input @error('SupportYn') is-invalid @enderror" 
                            v-model="form.DisplayYn" 
                            id="DisplayY" 
                            value="1"
                            name="DisplayYn">
                        <label class="custom-control-label" for="DisplayY">표시함</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" 
                            class="custom-control-input @error('SupportYn') is-invalid @enderror" 
                            v-model="form.DisplayYn" 
                            id="DisplayN" 
                            value="0"
                            name="DisplayYn">
                        <label class="custom-control-label" for="DisplayN">표시 안 함</label>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">제목</label>
            </th>
            <td colspan="3">
                <input type="text" 
                    class="form-control"
                    :class="{'is-invalid': validation.Title}"
                    v-model="form.Title" 
                    placeholder="제목을 입력해 주세요">
                <div class="invalid-feedback" v-if="validation.Title">
                    @{{ validation.Title[0] }}
                </div>
            </td>
            
        </tr>
        <tr>
            <th>
                <label class="label">첨부파일</label>
            </th>
            <td colspan="3">    
                <div id="drop-zone">
                    <div v-for="(file, index) in form.Files">
                        <span style="font-size: 15px; color:#4b5aaa">@{{ file.name }}</span> 
                        <i @click="delFile(index)" class="fas fa-times-circle pointer"></i>
                    </div>
                    <div class="here" v-if="form.Files.length === 0">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <br />
                        여기에 파일을 올려 놓으세요
                    </div>
                </div>
                <button type="button" class="btn-primary mt-2" @click="selFile">파일선택</button>

                <input type="file" class="hide" ref="inputFile" multiple>
            </td>
        </tr>
        <tr>
            <th>
                <label class="label">내용</label>
            </th>
            <td colspan="3">
                <div class="invalid-feedback" v-if="validation.Contents" style="display: block">
                    @{{ validation.Contents[0] }}
                </div>
                <textarea v-model="form.Contents" class="form-control" name="notice-board" id="notice-board"></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="btn-flex-area justify-content-end">
        <button 
            type="button" 
            class="btn btn-secondary"
            onclick="location.href='/notices'">취소</button>
        <button type="button" class="btn btn-primary" @click="trySubmit">저장</button>
    </div> <!-- /.register-btn-area -->
</section>

@endsection

@section('popup')
@endsection

@section('script')
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/axios.js"></script>
<script>
    var app = new Vue({
        el:'#wrapper-body',
        data:{
            CircuitList: [],
            form: {
                MetroID: "",
                CircuitID: "",
                ReceiveGroupID: "",
                DisplayYn: 1,
                Title: "",
                Contents: "",
                Files: []
            },
            validation: {
                ReceiveGroupID: false,
                Title: false,
                Contents: false
            }
        },
        computed: {
            fileSize: function () {
                var size = 0
                for (let index = 0; index < this.form.Files .length; index++) {
                    size += this.form.Files [index].size;
                }
                return size
            }
        },
        watch: {
            'form.MetroID': function () {
                this.CircuitID = '';
                this._getCircuitList();
            },
        },
        mounted: function () {
            this.$nextTick(function () {
                CKEDITOR.replace( 'notice-board' ,{
                    enterMode: CKEDITOR.ENTER_BR
                });

                var drop = document.getElementById('drop-zone');
                drop.ondragover = function(e) {
                    e.preventDefault();
                    drop.style.backgroundColor = '#cac7c7'
                };
                drop.ondragleave = function(e) {
                    drop.style.backgroundColor = '#fafafa'
                }
                drop.ondrop = function(e) {
                    e.preventDefault();
                    drop.style.backgroundColor = '#fafafa'
                    var data = e.dataTransfer;
                    if (data.items) {
                        for (var i = 0; i < data.items.length; i++) {
                            if (data.items[i].kind == "file") {
                                var file = data.items[i].getAsFile();
                                console.log(file)
                                app.pushFile(file)    
                            }
                        }
                    } else {
                        for (var i = 0; i < data.files.length; i++) {
                            alert(data.files[i].name);
                        }
                    }
                };

                var file = app.$refs.inputFile;
                file.onchange = function () {
                    var fileList = file.files;
                    for (var i = 0; i < fileList.length; i++) {
                        app.pushFile(fileList[i])         
                    }
                };
            
            })
        },
        methods:{
            _getCircuitList: function () {
                var params = {
                    params: {
                        MetroID: this.form.MetroID 
                    }
                };
                axios.get('/api/getCircuitList', params)
                    .then(function (response) {
                        console.log(response.data);
                        this.CircuitList = response.data;
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error.response)
                    });
            },
            pushFile: function(file) {
                if (this.fileSize >= 20000000) {
                    alert('용량이 초과 되었습니다.')
                    return false
                }
                if (this.form.Files.length >= 20) {
                    alert('더이상 등록할 수 없습니다.')
                    return false
                }
                for (let index = 0; index < this.form.Files.length; index++) {
                    if (this.form.Files[index].name == file.name) {
                        alert('이미 등록된 파일입니다.')
                        return false                                            
                    }
                }
                this.form.Files.push(file)
            },
            delFile: function(index) {
                this.form.Files.splice(index, 1)
            },
            selFile: function() {
                this.$refs.inputFile.click()
            },
            trySubmit: function() {
                var formData = new FormData();
                formData.append('MetroID', this.form.MetroID);
                formData.append('CircuitID', this.form.CircuitID);
                formData.append('ReceiveGroupID', this.form.ReceiveGroupID);
                formData.append('DisplayYn', this.form.DisplayYn);
                formData.append('Title', this.form.Title);
                formData.append('Contents', CKEDITOR.instances['notice-board'].getData());
                for (var i = 0; i < this.form.Files.length; i++) {
                    formData.append('Files[]', this.form.Files[i]);
                    console.log(this.form.Files[i])
                }

                axios.post('/notices/0/form', formData)
                .then(function (response) {
                    console.log(response);
                    location.href = '/notices'
                })
                .catch(function (error) {
                    console.log(error.response);
                    if (error.response.status === 422) {
                        console.log(error.response);
                        this.validation = error.response.data.errors
                    }
                }.bind(this));
            }
        }
    })


    
</script>
@endsection
