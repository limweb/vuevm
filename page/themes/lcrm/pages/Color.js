import crudmix from "../mixins/CrudMixin.js";
export default {
    template: `
<div>
    <h1>
        {{title}}
    </h1>
    <div v-show="viewstate.v_lists" ref="v_lists">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button v-show="!viewstate.v_insert" @click="insert" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Insert</button>
                <button class="btn btn-primary" @click="changeview('v_import')"><i class="fa fa-download"></i> Import</button>
                <button class="btn btn-primary" @click="changeview('v_export')"><i class="fa fa-upload"></i> Export</button>
                <button class="btn btn-primary" @click="printv"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">
                        archive</i> {{title}}
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display:block;">
                <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="dataTables_length" id="data_length">
                                                        <label>
                                                                Show
                                                                <select v-model="perpage" name="data_length" aria-controls="data" class="form-control input-sm">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                                entries
                                                            </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div id="data_filter" class="dataTables_filter">
                                                        <label>
                                                                Search:
                                                                <input v-model="filtertxt" type="search" class="form-control input-sm" placeholder="" aria-controls="data">
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" style="flow-x:auto;">
                                                    <table id="data" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="data_info" style="width: 737px;">
                                                        <thead>
                                                            <tr role="row">
                                                                <th width="80px;">
                                                                    <input type="checkbox" v-model="checked_all" @click="checkeall"> &nbsp;# </th>
                                                                <th v-for="(col,idx) in columns" v-show="col.visible" :tabindex="idx" :key="idx" :class="{ active: sortKey == col.key }" :style="{ cursor: col.orderable ? 'pointer' : '' }" @click="sortBy(col)">
                                                                    <div style="display:inline-flex;align-items:center">
                                                                        {{col.label}}
                                                                        <i v-show="col.orderable && sortKey != col.key " class="fa fa-sort pull-right" style="color: #ddd;" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==1" style="display:none" class="fa fa-sort-asc pull-right" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==-1" style="display:none" class="fa fa-sort-desc pull-right" aria-hidden="true"></i>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    Option
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(row,index) in lists" role="row" class="">
                                                                <td>
                                                                    <input type="checkbox" v-model="row.checked">&nbsp; {{index+1}}</td>
                                                                <td v-for="(col,idx) in columns" :key="idx" v-if="col.visible">
                                                                    <div stype="display:inline;">
                                                                            <span v-if="col.inputtype=='color'" :style="{background: row[col.key] }" style="padding: 7px;  text-align: center; display: inline-block;"></span>
                                                                            <span >{{row[col.key]}}</span>
                                                                    </div>
                                                                </td>
                                                                <td style="cursor: pointer;">
                                                                    <i @click="view(row)" class="fa fa-fw fa-eye text-primary"></i>
                                                                    <i @click="edit(row)" alt="edit" aria-hidden="true" class="fa fa-pencil"></i>
                                                                    <!-- <i @click="changeview('v_import')" alt="reset password" aria-hidden="true" class="fa fa-key"></i>  -->
                                                                    <!-- <i @click="changeview('v_export')" alt="reset password" aria-hidden="true" class="fa fa-key"></i>  -->
                                                                    <i @click="deleterow(row)" alt="delete" aria-hidden="true" class="fa fa-times-circle " style="color: red;"></i>
                                                                    <!-- <i @click="printv(row)" alt="print" aria-hidden="true" class="fa fa-print"></i> -->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div id="data_processing" class="dataTables_processing panel panel-default" style="display: none;">
                                                        Processing...
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="dataTables_paginate paging_simple_numbers" id="data_paginate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="data_paginate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                Showing {{itempagestart}} to {{itempageend}} of {{total}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <paginate ref="paginate" :page-count="totalpage" :prev-text="'Prev'" :next-text="'Next'" :click-handler="changepage" :container-class="'pagination'">
                            </paginate>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="viewstate.v_print" ref="v_print">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Print
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="form-group">
                    <div class="controls">
                        <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        <button @click="print" type="button" class="btn btn-success"><i class="fa fa-print"></i> PRINT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="viewstate.v_update" ref="v_update">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="updatecancel" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Update
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <form method="POST" action="#" accept-charset="UTF-8" id="company" enctype="multipart/form-data" novalidate="novalidate" class="bv-form">
                    <div v-for="(item,idx) in updateobj()" :key="idx" class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label v-bind:class="item.required" class="control-label" >{{item.label}}</label>
                                <div class="controls">
                                    <input v-if="item.inputtype=='textinput'" 
                                    v-validate="validateupdate(item)" 
                                    :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                    :placeholder="item.label" :name="item.key" type="text" v-model="row_update[item.key]" class="form-control"> <span class="help-block"></span>
                                    
                                    <input v-if="item.inputtype=='number'" 
                                    v-validate="validateupdate(item)" 
                                    :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                    :name="item.key" type="number" v-model="row_update[item.key]" class="form-control"> <span class="help-block"></span>
                                    
                                    <el-date-picker v-if="item.inputtype=='datetime-local'" 
                                    v-validate="validateupdate(item)" 
                                    :class="{'input': true, 'is-danger': errors.has(item.key) }"                                     
                                    format="yyyy-MM-dd HH:mm:ss" value-format="yyyy-MM-dd HH:mm:ss"
                                    v-model="row_update[item.key]"  type="datetime" placeholder="Select date and time" />
                                    
                                    <div v-if="item.inputtype=='color'" style="display: inline-flex; align-items: center;">
                                    <el-color-picker v-model="row_update[item.key]"></el-color-picker>
                                    <span>{{row_update[item.key]}}</span>
                                    </div>
                                    
                                    <textarea v-if="item.inputtype=='textarea'" 
                                    v-validate="validateupdate(item)" 
                                    :class="{'input': true, 'is-danger': errors.has(item.key) }"                                     
                                    :name="item.key" v-model="row_update[item.key]" rows="8" style="width:90%;"></textarea><span class="help-block"></span>
                                
                                </div>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">The address field is required.</small>
                            </div>
                        </div>
                        <!--              <div class="col-md-6">
                              <pre>{{item}}</pre>
                           </div> -->
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <a @click="updatecancel('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            <button @click="updated()" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div v-show="viewstate.v_insert" ref="v_insert">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="insertcancel" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Insert
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <form method="POST" action="#" accept-charset="UTF-8" id="company" enctype="multipart/form-data" novalidate="novalidate" class="bv-form">
                    <div v-for="(item,idx) in insertobj()" :key="idx" class="row">
                        <div class="col-md-12">
                            <div class="form-group required ">
                                <label class="control-label" v-bind:class="item.required">{{item.label}}</label>
                                <div class="controls">
                                    <input v-if="item.inputtype=='textinput'" :placeholder="item.label"
                                      v-validate="validateinsert(item)"
                                      :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                      :name="item.key" type="text" v-model="row_insert[item.key]" 
                                      class="form-control"> <span class="help-block"></span>
                                      
                                      <input v-if="item.inputtype=='number' && item.key != 'id'" 
                                      v-validate="validateinsert(item)"
                                      :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                      :name="item.key" type="number" 
                                      v-model="row_insert[item.key]" class="form-control"> <span class="help-block"></span>
                                      
                                      <el-date-picker v-if="item.inputtype=='datetime-local'" 
                                      v-validate="validateinsert(item)"
                                      :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                      v-model="row_insert[item.key]"  
                                      format="yyyy-MM-dd HH:mm:ss" value-format="yyyy-MM-dd HH:mm:ss"
                                      type="datetime" placeholder="Select date and time" />

                                    <div v-if="item.inputtype=='color'" style="display: inline-flex; align-items: center;">
                                    <el-color-picker v-model="row_insert[item.key]"></el-color-picker>
                                    <span>{{row_insert[item.key]}}</span>
                                    </div>                                      

                                    <textarea v-if="item.inputtype=='textarea'" 
                                      v-validate="validateinsert(item)"
                                     :class="{'input': true, 'is-danger': errors.has(item.key) }" 
                                    :name="item.key" v-model="row_insert[item.key]" rows="8" style="width:90%;"></textarea><span class="help-block"></span>
                                    
                                    <span v-if="item.inputtype=='number' && item.key == 'id'">{{item.key}}</span>

                                </div>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">The address field is required.</small>
                            </div>
                        </div>
                        <!--              <div class="col-md-6">
                              <pre>{{item}}</pre>
                           </div> -->
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <a @click="insertcancel('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            <button @click="inserted('v_lists')" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <div v-show="viewstate.v_delete" ref="v_delete">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} delete
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div v-for="(item,idx) in viewobj" :key="idx" class="form-group">
                    <label for="title" class="control-label">{{item.label}}</label>
                    <div class="controls">
                        {{item.value}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        <button @click="deleteyn(viewobj)" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_import" ref="import">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> Import {{title}} 
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="right_cont">
                    <div>
                    <form class="form-horizontal">
                    <div data-provides="fileinput" class="fileinput fileinput-new">
                    <span class="btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" name="..."></span> <span class="fileinput-filename"></span> 
                    <a href="#" data-dismiss="fileinput" class="close fileinput-exists import-cat">×</a></div> <br> 
                    <button class="btn btn-primary">Upload and Review</button> <a href="#" class="btn btn-primary">Download Template</a></form> <!----> <div class="table-responsive"><!----></div> <div class="row"><div class="col-md-12"><a href="" class="btn btn-primary pull-right disabled" style="display: none;">Create Selected</a></div></div></div></div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_export" ref="export">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} export
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="form-group">
                    <div class="controls">
                    <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                    <download-excel
                        key="slx"
                        class= "btn btn-default"
                        type="slx"
                        :data= "exportdatas()"
                        :name="exportxlsx()"
                        :fields = "json_fields()"
                        >
                        Download Excel
                    </download-excel>
                    <download-excel
                        key="csv"
                        type ="csv"
                        class= "btn btn-default"
                        :data= "exportdatas()"
                        v-bind:name="exportcsv()"
                        :fields = "json_fields()"
                        >
                        Download CSV
                    </download-excel>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_view" ref="view">
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} view
                </h4>
                <span class="pull-right">
                                 <i class="fa fa-fw fa-chevron-up clickable">
                                 </i>
                                 </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="right_cont">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix"></div>
                            <div class="details">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div v-for="(item,idx) in viewobj" :key="idx" class="form-group">
                                            <label for="title" class="control-label">{{item.label}}</label>
                                            <div class="controls">
                                                <div v-if="item.label=='RGB'" style="display:inline;">
                                                    <span :style="{background: item.value }" style="padding: 7px;  text-align: center; display: inline-block;"></span>
                                                </div>
                                                {{item.value}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
`,
    mixins: [crudmix],
    created() {
        console.log("crud template created");
    }
};