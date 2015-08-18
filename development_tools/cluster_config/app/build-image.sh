#!/usr/bin/env bash

cd ../../..
docker build --tag=bitgandtter/k8s_php_test .
cd development_tools/cluster_config/app/