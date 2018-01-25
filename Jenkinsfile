pipeline {
  agent any
  stages {
    stage('test') {
      steps {
        sh 'echo no test now test trigger'
      }
    }
    stage('build') {
      steps {
        sh 'sudo docker build . -t wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api'
      }
    }
    stage('push') {
      steps {
        sh 'sudo docker push registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker push registry.wip.camp/wip-api'
      }
    }
    stage('clean') {
      steps {
        sh 'sudo docker image rm registry.wip.camp/wip-api:$BUILD_NUMBER'
        sh 'sudo docker image rm registry.wip.camp/wip-api'
      }
    }
  }
  post {
    success {
      sh 'echo success'
    }
    failure {
      sh 'echo failure'
    }
  }
}