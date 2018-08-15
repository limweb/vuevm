export default {
    template: `
        <div class="col-md-12">
            <div class="form-group required ">
                <label class="control-label" v-bind:class='col.required' >{{col.label}}</label>
                <div class="controls">
                    <input v-if="col.inputtype=='textinput'" 
                        :placeholder='col.label' 
                        v-validate='validateinsert(col)'
                        :class="{'input': true, 'is-danger': errors.has(col.key) }"
                        :name= 'col.key'
                        type="text" 
                        v-model='item[col.key]' 
                        class="form-control">                                    

                    <input v-else-if="col.inputtype=='number' && col.key != 'id'"
                        v-validate='validateinsert(col)'
                        :class="{'input': true, 'is-danger': errors.has(col.key) }"
                        :name='col.key'
                        type="number" v-model='item[col.key]'
                        class="form-control" />

                    <el-date-picker v-else-if="col.inputtype=='datetime-local'"
                        v-validate='validateinsert(col)'
                        :class="{'input': true, 'is-danger': errors.has(col.key) }"
                        v-model='item[col.key]'
                        format="yyyy-MM-dd HH:mm:ss" value-format="yyyy-MM-dd HH:mm:ss" type="datetime"
                        placeholder="Select date and time" />

                    <textarea v-else-if="col.inputtype=='textarea'"
                        v-validate='validateinsert(col)'
                        :class="{'input': true, 'is-danger': errors.has(col.key) }"
                        :name='col.key'
                        v-model='item[col.key]'
                        rows="8" style="width:90%;"></textarea>

                    <span v-else-if="col.inputtype =='number' && col.key == 'id'">{{col.key}}</span>

                    <div v-else-if= "col.inputtype== 'checkbox' && col.key == 'status'">
                        <input type="checkbox" :name='col.key'
                            v-model='item[col.key]'> 
                            {{fcstatus(item[col.key])}}
                        </input>
                    </div>

                    <div  v-else-if="col.inputtype=='checkbox' && col.key == 'visible'">
                        <input type="checkbox" :name='col.key'
                            v-model='item[col.key]' >
                                {{fcvisible(item[col.key])}}
                        </input>
                    </div>

                    <div  v-else-if="col.inputtype=='checkbox'">
                        <input type="checkbox" :name='col.key'
                            v-model='item[col.key]' >
                                {{item[col.key]}}
                        </input>
                    </div>

                    <div v-else-if="col.inputtype=='select'" >
                        <select v-model='item[col.key]' name="data_length" aria-controls="data" class="form-control input-sm">
                            <option v-for="(opt,idx) in col.items" :key="idx" :value="opt[col.key_view.keyid]">{{selectlabel(opt,col)}}</option>
                        </select>
                    </div>

                    <div v-else-if="col.inputtype=='color'"
                        style="display: inline-flex; align-items: center;">
                        <el-color-picker  v-if="col.inputtype=='color'"
                        v-model='item[col.key]'>
                        </el-color-picker>
                        <span>{{item[col.key]}}</span>
                    </div>

                    <span v-else>{{item[col.key]}}</span>
                    <span class="help-block"></span>
                </div>
                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">The address field is required.</small>
            </div>
        </div>
    `,
    props: {
        col: {
            type: Object,
            required: true
        },
        item: {
            type: Object,
            required: true
        }
    },
    data() {
        return {};
    },
    methods: {
        selectlabel(opt, col) {
            let separated = "";
            if (typeof col.key_view.separated != "undefined")
                separated = col.key_view.separated;
            return col.key_view.label.map(r => opt[r]).join(separated);
        },
        validateinsert(item) {
            if (item.required) {
                return item.required;
            } else {
                return "";
            }
        },
        fcvisible(vi) {
            if (vi) {
                return "Visible";
            } else {
                return "Invisible";
            }
        },
        fcstatus(sta) {
            if (sta) {
                return "Active";
            } else {
                return "Inactive";
            }
        }
    }
};