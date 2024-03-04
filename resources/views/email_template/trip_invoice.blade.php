<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Invoice</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="{{ asset('mail/bootstrap.min.css') }}"
    />
    
    <style>
      .card {
        border-top: 30px solid #f89520;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        padding: 0 20px;
      }
      .pro {
        background: #f89520;
        padding: 10px 20px;
        color: #fff;
      }

      .table > tbody > tr > td,
      .table > tbody > tr > th,
      .table > tfoot > tr > td,
      .table > tfoot > tr > th,
      .table > thead > tr > td,
      .table > thead > tr > th {
        border: 1px solid #ddd;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <section class="card p-3">
        <div class="card-body">
          <!-- Invoice Company Details -->

          <!--/ Invoice Company Details -->
          <!-- Invoice Customer Details -->
          <div id="invoice-customer-details" class="row pt-2">
            <div class="col-md-6 col-sm-12 text-left text-md-left">
              <img
                src="https://mechaniclane.com/assets/img/m_logo.png"
                style="width: 300px"
              />
            </div>
            <div class="col-md-6 col-sm-12 text-right text-md-right">
              <p>
                <span class="text-muted"><b>GSTIN:</b></span> 06AAVCA0152D1ZY
              </p>
              <p>
                <span class="text-muted"
                  ><b>Automechanical Innovations Pvt Ltd</b></span
                >
              </p>
              <p>
                <span class="text-muted"
                  >Tikri Null, Sector 48, Gurgaon Haryana 122018, India</span
                >
                10/05/2016
              </p>
            </div>
          </div>
          <br /><br /><br />
          <div id="invoice-customer-details" class="row pt-2">
            <div class="col-md-6 col-sm-12 text-left text-md-left">
              <ul class="px-0 list-unstyled">
                <li class="text-bold-800"><b>Term and Agreements:</b></li>
                <li>
                  Lorem Ipsum is simply dummy text of the <br />printing and
                  typesetting industry. <br />printing and typesetting industry.
                </li>
              </ul>
            </div>
            
            <div class="col-md-6 col-sm-12 text-left text-md-right">
              <div class="row">
                <div class="col-md-12 pro">
                  <div class="col-md-6" style="border-right: 2px solid #f9aa4d">
                    <p>Invoice Number</p>
                    <b>#45673</b>
                    <br /><br />
                    <p>Invoice Date</p>
                    <b>12 August 2022</b>
                  </div>
                  <div class="col-md-6">
                    <p>Total Due</p>
                    <h3><strong>{{ $total_price }}</strong></h3>
                  </div>
                </div>
              </div>
            </div>
            
          </div>

          <br /><br /><br />
          <!--/ Invoice Customer Details -->
          <!-- Invoice Items Details -->
          <div id="invoice-items-details" class="pt-2">
            <div class="row">
              <div class="table-responsive col-sm-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>ITEM</th>
                      <th class="text-right">FEE</th>
                      <th class="text-right">QUANTITY</th>
                      <th class="text-right">TOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($packages as $list)
                        <tr>
                          <td>
                            <p>{{ $list->package_name }}</p>
                          </td>
                          <td class="text-right">{{ $list->price }}</td>
                          <td class="text-right">1</td>
                          <td class="text-right">{{ $list->price }}</td>
                        </tr>
                    @endforeach
                    

                    <tr>
                      <td rowspan="3">
                        <h3>Terms:10 Days From Issue</h3>
                      </td>
                      <td class="text-left" colspan="2"><b>Subtotal</b></td>
                      <td class="text-left"><b>{{ $total_price }}</b></td>
                    </tr>

                    <tr>
                      <td class="text-left" colspan="2"><b>Tax</b></td>
                      <td class="text-left"><b>0</b></td>
                    </tr>

                    <tr>
                      <td class="text-left" colspan="3">
                        <b>Total &nbsp; &nbsp;&nbsp;{{$total_price}}</b>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Invoice Footer -->

          <div class="row">
            <div class="col-md-4">
              <b>Payment Information</b>
              <p>Bank mandir indonesia</p>
              <p>1458758245879525</p>
              <p>Account no:125487325</p>
            </div>

            <div class="col-md-4">
              <b>Clent Information</b>
              <b>Payment Information</b>
              <p>Bank mandir indonesia</p>
              <p>1458758245879525</p>
              <p>Account no:125487325</p>
            </div>

            <div class="col-md-4">
              <div class="text-center">
                <p>Authorized person</p>
                <img
                  data-savepage-src="../../../app-assets/images/pages/signature-scan.png"
                  src="data:image/png;base64,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"
                  alt="signature"
                  class="height-100"
                />
                <h6>Amanda Orton</h6>
                <p class="text-muted">Managing Director</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
