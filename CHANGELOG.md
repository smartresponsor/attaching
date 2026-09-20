# Changelog

All notable changes to this repository will be documented in this file.

The format is based on Keep a Changelog and this component follows a pre-release-first discipline until its first stable tag.

## [Unreleased]

### Changed
- Canonicalized public attachment transport records under `App\Attaching\DTO\...` with `*DTO` type/file suffixes; consumers of the previous `App\Attaching\Dto\...` unsuffixed classes must update imports and type names
- Canonicalized local first-party development Composer path dependencies to exact `dev-master` identities with explicit path repository version overrides
- Canonicalized component-owned Attachment class names, DTO names/paths, repository-interface mirror paths, and local-storage naming to the current subject-first/type-explicit platform rules
- Aligned Doctrine DQL embedded-property paths with the current Objecting `dev-master` metadata (`objectState.status`, `objectAudit.createdAt`)

### Fixed
- Repaired GitHub Actions CI so the canonical sibling `path` repositories are checked out with the shared Automater GitHub App before Composer install
- Canonicalized attachment lifecycle persistence on Objecting state fields and removed duplicate status mapping
- Aligned identifier-migration rebuild SQL with current Objecting physical column names

### Security
- Refresh Symfony dependency locks to patched releases resolving current Composer audit advisories
- Confine local attachment storage paths to safe relative paths under the configured storage root

### Added
- Antora-compatible producer documentation surface
- GitHub Actions CI workflow for PHP 8.4 quality gates
- Initial release-process and documentation discoverability surface

## [0.1.0-pre]

### Added
- Initial Symfony-oriented attaching component baseline
- Doctrine ORM persistence baseline
- Local quality gates for PHPStan, PHPUnit, and PHP CS Fixer
