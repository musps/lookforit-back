# LOOK FOR IT API

Current version = `v1`

# Routes

| How to make a call |
| ----
| `{$endpoint}`/`{$version}`/`{$target}`/`{$path}`

## Routes Auth 

* Target = `auth`

| Path 
| ---
| log_in
| log_out
| register

## Routes Private

* Target = `private`

| Path 
| ---
| user/me
| user_address/me
| user_address/create
| user_address/by_id/`{id}`
| user_address/update/`{id}`
| user_address/delete/`{id}`

## Routes Public

* Target = `/public`

| Path 
| ---
