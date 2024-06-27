@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Proses Perhitungan</h5>
                    <p class="card-description">
                        Proses perhitungan dengan metode Double Exponential Smoothing menggunakan nilai alpha (2),
                        berdasarkan data aktual yang telah di input.
                    </p>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Data Aktual</th>
                                    <th scope="col">S1</th>
                                    <th scope="col">S2</th>
                                    <th scope="col">a</th>
                                    <th scope="col">b</th>
                                    <th scope="col">f</th>
                                    <th scope="col">e</th>
                                    <th scope="col">abs-e</th>
                                    <th scope="col">pe</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1</td>
                                    <td>120</td>
                                    <td>120</td>
                                    <td>0</td>
                                    <td>120</td>
                                    <td>0</td>
                                    <td>120</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0%</td>

                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2</td>
                                    <td>130</td>
                                    <td>120</td>
                                    <td>10</td>
                                    <td>121</td>
                                    <td>9</td>
                                    <td>130</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0%</td>

                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>3</td>
                                    <td>125</td>
                                    <td>122.9</td>
                                    <td>8.1</td>
                                    <td>123</td>
                                    <td>7.9</td>
                                    <td>132</td>
                                    <td>7</td>
                                    <td>7</td>
                                    <td>5.6%</td>

                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>4</td>
                                    <td>140</td>
                                    <td>127.8</td>
                                    <td>11.2</td>
                                    <td>128</td>
                                    <td>11.1</td>
                                    <td>138</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>1.4%</td>

                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>5</td>
                                    <td>135</td>
                                    <td>130.9</td>
                                    <td>10.1</td>
                                    <td>131</td>
                                    <td>10.2</td>
                                    <td>142</td>
                                    <td>7</td>
                                    <td>7</td>
                                    <td>5.2%</td>

                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>6</td>
                                    <td>150</td>
                                    <td>136.1</td>
                                    <td>13.9</td>
                                    <td>137</td>
                                    <td>14</td>
                                    <td>148</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td>1.3%</td>

                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>7</td>
                                    <td>145</td>
                                    <td>139.4</td>
                                    <td>12.6</td>
                                    <td>139</td>
                                    <td>12.8</td>
                                    <td>151</td>
                                    <td>6</td>
                                    <td>6</td>
                                    <td>4.1%</td>

                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>8</td>
                                    <td>160</td>
                                    <td>144.7</td>
                                    <td>15.3</td>
                                    <td>145</td>
                                    <td>15.4</td>
                                    <td>159</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>0.6%</td>

                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>9</td>
                                    <td>155</td>
                                    <td>148.8</td>
                                    <td>14.2</td>
                                    <td>149</td>
                                    <td>14.3</td>
                                    <td>164</td>
                                    <td>9</td>
                                    <td>9</td>
                                    <td>5.8%</td>

                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>10</td>
                                    <td>150</td>
                                    <td>150.6</td>
                                    <td>12.4</td>
                                    <td>151</td>
                                    <td>12.5</td>
                                    <td>164</td>
                                    <td>14</td>
                                    <td>14</td>
                                    <td>9.3%</td>

                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Hasil Perhitungan</h5>
                    <p class="card-description">
                        Dari proses diatas, maka didapatkan hasil perhitungan untuk 3 periode selanjutnya sebagai berikut :
                    </p>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Data Aktual</th>
                                    <th scope="col">Hasil Prediksi</th>
                                    <th scope="col">Presentase Error</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>1</td>
                                    <td>120</td>
                                    <td>120</td>
                                    <td>0%</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2</td>
                                    <td>130</td>
                                    <td>120</td>
                                    <td>7.69%</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>3</td>
                                    <td>125</td>
                                    <td>121</td>
                                    <td>3.20%</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>4</td>
                                    <td>140</td>
                                    <td>126</td>
                                    <td>10.00%</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>5</td>
                                    <td>135</td>
                                    <td>130</td>
                                    <td>3.70%</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>6</td>
                                    <td>150</td>
                                    <td>136</td>
                                    <td>9.33%</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>7</td>
                                    <td>145</td>
                                    <td>139</td>
                                    <td>4.14%</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>8</td>
                                    <td>160</td>
                                    <td>145</td>
                                    <td>9.38%</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>9</td>
                                    <td>155</td>
                                    <td>150</td>
                                    <td>3.23%</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>10</td>
                                    <td>150</td>
                                    <td>154</td>
                                    <td>2.67%</td>
                                </tr>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik perbandingan</h5>
                    <div id="apex1"></div>
                </div>
            </div>
            <div class="">
                <button class="btn btn-success">Export Excel</button>
                <button class="btn btn-danger">Print PDF</button>
            </div>
        </div>
    </div>
@endsection
