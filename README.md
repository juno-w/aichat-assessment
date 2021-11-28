# AiChat Assessment


## Usage
### 1. Installation
Install dependencies
```bash
composer install
```
Generate app key
```
php artisan key:generate
```

### 2. Start the server (Docker)
```bash
./vendor/bin/sail up -d
```

### 3. Database Seeding
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## API
### Check Customer Eligibility

#### Request
```
GET http://localhost/api/campaign/8354e8fe-dac0-415c-8bd9-7e97b0fbc37b
```
#### Path parameters

| Parameter name | Value  | Description                             | Additional |
| -------------- | ------ | --------------------------------------- | ---------- |
| email          | string | Customer's email address to be checked. | Required   |

#### Response
```json
{
  "message": "Congrats! You're eligible for this campaign. Kindly proceed to upload your photo with product to redeem the voucher in 10 minutes time. First come first serve basis."
}
```

### Redeem Voucher

#### Request
```
GET http://localhost/api/campaign/8354e8fe-dac0-415c-8bd9-7e97b0fbc37b/redeem-voucher
```
#### Path parameters

| Parameter name | Value             | Description                                                          | Additional |
| -------------- | ----------------- | -------------------------------------------------------------------- | ---------- |
| email          | string            | Customer's email address to be checked.                              | Required   |
| file           | mimes:jpg,bmp,png | Photo contains company's product to be checked by image recognition. | Required   |

#### Response
```json
{
  "code": "FRMBD2"
}
```