<template>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-4">
        <div class="card-body">
            <div class="text-center">
                Last Update : {{ globalConfig.formatCompat(last_update) }} <br />
                Time : {{ time }}
            </div>
            <template v-if="isLoading">
                <div class="page-loader">
                    <div class="loading-spinner">
                        <div class="spinner-border"></div>
                    </div>
                    <h3>Loading Data</h3>
                </div>
            </template>
            <template v-else>
                <template v-if="table_data">
                    <div class="row">
                        <div class="col-2">
                            <table class="table table-bordered solid display">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="2">
                                            SPECIMEN COLLECTION
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CITO/EA</th>
                                        <th>NON CITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.sc" class="text-center">
                                        <template v-for="(show, data_key
                                        ) in data">
                                            <template v-if="show">
                                                <template v-if="
                                                    show.type ==
                                                    '1'
                                                ">
                                                    <td style="background: #ff0000; padding:0px;">
                                                        <strong>
                                                            <p class="regno_font">
                                                                {{
                                                                    show
                                                                        ? show.reg_no.substr(
                                                                            show
                                                                                .reg_no
                                                                                .length -
                                                                            4
                                                                        )
                                                                        : ""
                                                                }}
                                                            </p>
                                                        </strong>
                                                    </td>
                                                </template>
                                                <template v-if="
                                                    show.type ==
                                                    '2'
                                                ">
                                                    <td style="background: #ffff00; padding:0px;">
                                                        <strong>
                                                            <p class="regno_font">
                                                                {{
                                                                    show
                                                                        ? show.reg_no.substr(
                                                                            show
                                                                                .reg_no
                                                                                .length -
                                                                            4
                                                                        )
                                                                        : ""
                                                                }}
                                                            </p>
                                                        </strong>
                                                    </td>
                                                </template>
                                                <template v-if="
                                                    show.type ==
                                                    '3'
                                                ">
                                                    <td style="background: #00ff73; padding:0px;">
                                                        <strong>
                                                            <p class="regno_font">
                                                                {{
                                                                    show
                                                                        ? show.reg_no.substr(
                                                                            show
                                                                                .reg_no
                                                                                .length -
                                                                            4
                                                                        )
                                                                        : ""
                                                                }}
                                                            </p>
                                                        </strong>
                                                    </td>
                                                </template>
                                                <template v-if="
                                                    show.type ==
                                                    '4'
                                                ">
                                                    <td style="background: #00b0f0; padding:0px;">
                                                        <strong>
                                                            <p class="regno_font">
                                                                {{
                                                                    show
                                                                        ? show.reg_no.substr(
                                                                            show
                                                                                .reg_no
                                                                                .length -
                                                                            4
                                                                        )
                                                                        : ""
                                                                }}
                                                            </p>
                                                        </strong>
                                                    </td>
                                                </template>
                                                <template v-if="
                                                    show.type ==
                                                    '5'
                                                ">
                                                    <td style="background: #e6e6e6; padding:0px;">
                                                        <strong>
                                                            <p class="regno_font">
                                                                {{
                                                                    show
                                                                        ? show.reg_no.substr(
                                                                            show
                                                                                .reg_no
                                                                                .length -
                                                                            4
                                                                        )
                                                                        : ""
                                                                }}
                                                            </p>
                                                        </strong>
                                                    </td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <td></td>
                                            </template>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="2">
                                            PROCESS SAMPLE
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CITO/EA</th>
                                        <th>NON CITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.ps" class="text-center">
                                        <template v-for="(show, data_key
                                        ) in data">
                                            <template v-if="
                                                data_key ==
                                                'cito'
                                            ">
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="2">RESULT</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CITO/EA</th>
                                        <th>NON CITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.rs" class="text-center">
                                        <template v-for="(show, data_key
                                        ) in data">
                                            <template v-if="
                                                data_key ==
                                                'cito'
                                            ">
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="2">
                                            VERIFICATION
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CITO/EA</th>
                                        <th>NON CITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.vr" class="text-center">
                                        <template v-for="(show, data_key
                                        ) in data">
                                            <template v-if="
                                                data_key ==
                                                'cito'
                                            ">
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="2">
                                            AUTHORIZATION
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CITO/EA</th>
                                        <th>NON CITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.au" class="text-center">
                                        <template v-for="(show, data_key
                                        ) in data">
                                            <template v-if="
                                                data_key ==
                                                'cito'
                                            ">
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <template v-if="show">
                                                    <template v-if="
                                                        show.type ==
                                                        '1'
                                                    ">
                                                        <td style="background: #ff0000; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '2'
                                                    ">
                                                        <td style="background: #ffff00; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '3'
                                                    ">
                                                        <td style="background: #00ff73; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '4'
                                                    ">
                                                        <td style="background: #00b0f0; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                    <template v-if="
                                                        show.type ==
                                                        '5'
                                                    ">
                                                        <td style="background: #e6e6e6; padding:0px;">
                                                            <strong>
                                                                <p class="regno_font">
                                                                    {{
                                                                        show
                                                                            ? show.reg_no.substr(
                                                                                show
                                                                                    .reg_no
                                                                                    .length -
                                                                                4
                                                                            )
                                                                            : ""
                                                                    }}
                                                                </p>
                                                            </strong>
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <td></td>
                                                </template>
                                            </template>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr class="text-center">
                                        <th>KRITIS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index
                                    ) in table_data.kr" class="text-center">
                                        <template v-if="data.type == '1'">
                                            <td style="
                                                                    background: #f4b084; padding:0px;
                                                                ">
                                                <strong>
                                                    <p class="regno_font">
                                                        {{
                                                            data
                                                                ? data.reg_no.substr(
                                                                    data
                                                                        .reg_no
                                                                        .length -
                                                                    4
                                                                )
                                                                : ""
                                                        }}
                                                    </p>
                                                </strong>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </div>
    <div class="card border-0 rounded-3 shadow-border-top-purple mt-4">
        <div class="card-body">
            <template v-if="isLoading">
                <div class="page-loader">
                    <div class="loading-spinner">
                        <div class="spinner-border"></div>
                    </div>
                    <h3>Loading Data</h3>
                </div>
            </template>
            <template v-else>
                <div>
                    <table class="table table-bordered solid display">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 5%;">No</th>
                                <th>Regno</th>
                                <th>TAT Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data, index
                            ) in table_data.tat" class="text-center">
                                <td>
                                    <p class="regno_font">{{ data.seq_no }}</p>
                                </td>
                                <td>
                                    <p class="regno_font">{{ data.regno }}</p>
                                </td>
                                <td>
                                    <p class="regno_font">{{ data.tat }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, computed, reactive, onBeforeUnmount } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { globalConfig } from '../globalConfig.js';

const props = defineProps({
    series: Array,
    link: String,
    refreshInterval: Number,
});

const table_data = ref({});
const last_update = ref('');
const time = ref('');
const isLoading = ref(false);
let intervalId = null;
let refreshRate = 1;
let timeCount = props.refreshInterval;

onMounted(() => {
    get_monitoring_data();
    intervalId = setInterval(() => {
        checkTime();
        time.value = Intl.DateTimeFormat(navigator.language, {
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
            hourCycle: "h23", // 24-hour format
        }).format();
    }, 1000);
});

onBeforeUnmount(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});

const checkTime = () => {
    refreshRate = globalConfig.get('refreshRate');
    if (refreshRate > 0) {
        if (Math.floor(Date.now() / 1000) % 60 == 0) {
            timeCount += 1;
        }
        if (timeCount == refreshRate) {
            get_monitoring_data();
        }
    }
};

const get_monitoring_data = () => {
    isLoading.value = true;
    timeCount = 0;
    axios.get(`/${props.link}`, {
        params: {
        }
    })
        .then(res => {
            const data = res.data;
            table_data.value = data.data;
            last_update.value = data.data.last_update;

            isLoading.value = false;
        })
        .catch(() => {
            isLoading.value = false;
            Swal.fire({
                icon: 'error',
                title: 'Fetch Failed',
                text: 'Unable to get data.',
                timer: 2000
            });
        });
};
</script>
