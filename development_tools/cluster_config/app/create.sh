#!/usr/bin/env bash

kubectl -s http://127.0.0.1:8080 create -f app.rc.yml
kubectl -s http://127.0.0.1:8080 create -f app.service.yml