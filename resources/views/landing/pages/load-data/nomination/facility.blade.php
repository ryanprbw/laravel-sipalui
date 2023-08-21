<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-sm">
                <tbody>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td width="25%">Kepemilikan Rumah</td>
                    <td width="5%">:</td>
                    <td>{{ $family->family_house }}</td>
                </tr>
                <tr>
                    <td>Fasilitas BAB</td>
                    <td>:</td>
                    <td>{{ $family->family_facility_defecation }}</td>
                </tr>
                <tr>
                    <td>Jenis Atap</td>
                    <td>:</td>
                    <td>{{ $family->family_type_roof }}</td>
                </tr>
                <tr>
                    <td>Jenis Dinding</td>
                    <td>:</td>
                    <td>{{ $family->family_type_wall }}</td>
                </tr>
                <tr>
                    <td>Jenis Lantai</td>
                    <td>:</td>
                    <td>{{ $family->family_type_floor }}</td>
                </tr>
                <tr>
                    <td>Sumber Penerangan</td>
                    <td>:</td>
                    <td>{{ $family->family_type_lighting }}</td>
                </tr>
                <tr>
                    <td>Bahan Bakar Masak</td>
                    <td>:</td>
                    <td>{{ $family->family_type_cooking }}</td>
                </tr>
                <tr>
                    <td>Sumber Air Minum</td>
                    <td>:</td>
                    <td>{{ $family->family_type_drinking }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
